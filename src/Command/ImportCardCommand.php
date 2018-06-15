<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;
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

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName('app:import-cards')
            ->setDescription('Import cards from a csv file')
            ->setHelp('This command reads a csv file passed in argument, splits it, and creates a Card for each line')
            ->addArgument('filepath', InputArgument::REQUIRED, 'Path to the file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handle = fopen($input->getArgument('filepath'), 'r');
        if (false === $handle) {
            throw new \InvalidArgumentException('Cannot open file for reading.');
        }

        $index = 0;

        while (false !== ($line = fgetcsv($handle))) {
            $card = new Card($line[0]);
            $card->setLink($line[2]);
            $this->entityManager->persist($card);
        }

        fclose($handle);
        $this->entityManager->flush();
    }
}
