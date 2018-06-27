<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Card;
use App\Entity\Link;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of ImportCardCommand
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class ImportCardCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Client
     */
    private $client;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->client = new Client();
    }

    protected function configure()
    {
        $this
            ->setName('app:import:cards')
            ->setDescription('Import cards from a csv file')
            ->setHelp('This command reads a csv file passed in argument, splits it, and creates a Card for each line')
            ->addArgument('filepath', InputArgument::REQUIRED, 'Path to the file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handle = fopen($input->getArgument('filepath'), 'r');
        if (false === $handle) {
            throw new \InvalidArgumentException('Cannot open file for reading.');
        }

        while (false !== ($line = fgetcsv($handle))) {
            $card = new Card($line[0]);
            if (isset($line[1])) {
                $this->createWikipediaLink($card, $line[1]);
            }

            $this->entityManager->persist($card);
        }

        fclose($handle);
        $this->entityManager->flush();
    }

    private function getPageinfo(string $title): ?array
    {
        $url = 'https://fr.wikipedia.org/w/api.php?' . http_build_query([
                'action' => 'query',
                'titles' => $title,
                'prop'   => 'info',
                'inprop' => 'url',
                'format' => 'json',
            ]);

        $response = $this->client->get($url);
        $json = (string) $response->getBody();
        $content = \GuzzleHttp\json_decode($json, true);

        $pageinfo = array_shift($content['query']['pages']);

        return $pageinfo;
    }

    private function createWikipediaLink(Card $card, string $title)
    {
        $pageinfo = $this->getPageinfo($title);

        $link = new Link();
        $link->setCard($card);
        $link->setSite(Link::SITE_WIKIPEDIA);
        $link->setTitle($title);
        $link->setUrl($pageinfo['fullurl']);
        $link->setExternalId(strval($pageinfo['pageid']));

        $this->entityManager->persist($link);
    }
}
