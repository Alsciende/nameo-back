<?php

declare(strict_types=1);

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
class ImportWikipediaCommand extends Command
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
            ->setName('app:import:wikipedia')
            ->setDescription('Import Wikipedia popularity data');
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
        if (null === $pageSearch) {
            $this->output->writeln('<error>' . $card->getTitle() . ',NULL,NULL</error>');
        } else {
            $pageInfo = $this->getPageInfo($pageSearch['pageid']);
            $pageViews = $this->getPageViews($pageInfo);
            $this->output->writeln($card->getTitle() . ',' . $pageSearch['title'] . ',' . $pageViews . ',' . $pageInfo['fullurl']);
        }
    }

    private function getPageViews(array $pageInfo): string
    {
        $infoUrl = str_replace('action=edit', 'action=info', $pageInfo['editurl']);
        $crawler = new Crawler($this->client->get($infoUrl)->getBody()->getContents());
        $crawler = $crawler->filter('#mw-pvi-month-count .mw-pvi-month');

        return $crawler->html();
    }

    private function getPageInfo(int $pageId): array
    {
        $url = 'https://fr.wikipedia.org/w/api.php?' . http_build_query([
                'action' => 'query',
                'pageids' => $pageId,
                'prop' => 'info',
                'inprop' => 'url',
                'format' => 'json',
            ]);

        $request = new Request('GET', $url);

        $response = $this->client->send($request);
        $json = (string) $response->getBody();
        $content = \GuzzleHttp\json_decode($json, true);

        return $content['query']['pages'][$pageId];
    }

    private function getPageSearch(Card $card): ?array
    {
        $url = 'https://fr.wikipedia.org/w/api.php?' . http_build_query([
                'action' => 'query',
                'list' => 'search',
                'srsearch' => $card->getTitle(),
                'utf8' => '',
                'format' => 'json',
            ]);

        $request = new Request('GET', $url);
        $response = $this->client->send($request);
        $json = (string) $response->getBody();
        $content = \GuzzleHttp\json_decode($json, true);

        if ('' !== $content['batchcomplete']) {
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
