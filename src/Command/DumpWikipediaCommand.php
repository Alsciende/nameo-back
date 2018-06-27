<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Card;
use App\Entity\Link;
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
class DumpWikipediaCommand extends Command
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
            ->setName('app:dump:wikipedia')
            ->setDescription('Dump Wikipedia popularity data');
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
        $link = $this->entityManager->getRepository(Link::class)->findOneBy(['card' => $card, 'site' => Link::SITE_WIKIPEDIA]);
        $pageInfo = $this->getPageInfo($link->getExternalId());
        $pageViews = $this->getPageViews($pageInfo);
        $this->output->writeln($card->getTitle() . ',' . $link->getTitle() . ',' . $pageViews . ',' . $pageInfo['fullurl']);
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
                'action'  => 'query',
                'pageids' => $pageId,
                'prop'    => 'info',
                'inprop'  => 'url',
                'format'  => 'json',
            ]);

        $response = $this->client->get($url);
        $json = (string) $response->getBody();
        $content = \GuzzleHttp\json_decode($json, true);

        return $content['query']['pages'][$pageId];
    }
}
