<?php

namespace App\Command;

use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Description of GoogleSuggestionsCommand
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class GoogleSuggestionsCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->client = new Client();
    }

    protected function configure()
    {
        $this
            ->setName('app:google-suggestions')
            ->setDescription('Check card title against Google suggestion API')
            ->setHelp('This command prints all cards for which Google suggets a different name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $cards = $this->entityManager->getRepository(Card::class)->findAll();
        foreach ($cards as $card) {
            $this->check($card);
        }
    }

    private function check(Card $card)
    {
        $pageSearch = $this->getPageSearch($card);
        if ($pageSearch === null) {
            $this->output->writeln('<error>' . $card->getTitle() . ',NULL,NULL</error>');
        } else {
            $pageViews = $this->getPageViews($pageSearch['pageid']);
            $this->output->writeln($card->getTitle() . ',' . $pageSearch['title'] . ',' . $pageViews);
        }
    }

    private function getPageViews($pageId): string
    {
        $crawler = new Crawler($this->client->get($this->getPageInfo($pageId))->getBody()->getContents());
        $crawler = $crawler->filter('#mw-pvi-month-count .mw-pvi-month');

        return $crawler->html();
    }

    private function getPageInfo(int $pageId)
    {
        $url = 'https://fr.wikipedia.org/w/api.php?' . http_build_query([
                'action'  => 'query',
                'pageids' => $pageId,
                "prop"    => "info",
                "inprop"  => "url",
                "format"  => "json",
            ]);

        $request = new Request('GET', $url);
        $client = new Client();
        $response = $this->client->send($request);
        $json = (string) $response->getBody();
        $content = \GuzzleHttp\json_decode($json, true);

        $editUrl = $content['query']['pages'][$pageId]['editurl'];

        return str_replace('action=edit', 'action=info', $editUrl);
    }

    private function getPageSearch(Card $card): ?array
    {
        $url = 'https://fr.wikipedia.org/w/api.php?' . http_build_query([
                'action'   => 'query',
                'list'     => "search",
                'srsearch' => $card->getTitle(),
                "utf8"     => "",
                "format"   => "json",
            ]);

        $request = new Request('GET', $url);
        $response = $this->client->send($request);
        $json = (string) $response->getBody();
        $content = \GuzzleHttp\json_decode($json, true);

        if ($content['batchcomplete'] !== '') {
            throw new \RuntimeException('batchcomplete not empty for ' . $card->getTitle());
        }

        $search = $content['query']['search'];
        if (empty($search)) {
            return null;
        }

        $match = reset($search);

        return $match;
    }

}