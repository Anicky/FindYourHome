<?php

// src/Command/ImportEstates.php
namespace App\Command;

use App\Service\EstateListingSiteCrawlerChain;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportEstates extends Command
{

    private $estateListingSiteCrawlerChain;

    private $entityManager;

    public function __construct(
        EstateListingSiteCrawlerChain $estateListingSiteCrawlerChain,
        EntityManagerInterface $entityManager
    ) {
        $this->estateListingSiteCrawlerChain = $estateListingSiteCrawlerChain;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected static $defaultName = 'app:import-estates';

    protected function configure()
    {
        $this->setDescription('Import estates from available estate listing sites.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $estates = $this->estateListingSiteCrawlerChain->getEstates();
        if (!empty($estates)) {
            foreach ($estates as $estate) {
                $this->entityManager->persist($estate);
            }
            $this->entityManager->flush();
        }
        return Command::SUCCESS;
    }
}