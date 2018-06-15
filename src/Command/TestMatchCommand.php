<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Match;
use App\Service\CardDrawingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of TestMatchCommand
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class TestMatchCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CardDrawingService
     */
    private $drawing;

    public function __construct(EntityManagerInterface $entityManager, CardDrawingService $drawing)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->drawing = $drawing;
    }

    public function configure()
    {
        $this
            ->setName('app:test-match');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $match = new Match(
            30,
            2,
            4,
            2,
            date('Y-m-d\TH:i:s.vP')
        );
        $this->entityManager->persist($match);
        $this->entityManager->flush();

        $this->drawing->drawCards($match);
    }
}
