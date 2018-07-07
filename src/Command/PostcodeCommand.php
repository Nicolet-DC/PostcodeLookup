<?php

namespace App\Command;

use App\Controller\PostcodeController;
use App\Utils\PostcodesGateway;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PostcodeCommand extends Command
{
    protected static $defaultName = 'PostcodeCommand';

    protected function configure()
    {
        $this->setDescription('Collect and up to date copy of UK Postcodes and store them');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $postcodeGateway = new PostcodesGateway();
        $postcodeGateway->updatePostcodesArchive();
        $postcodes = $postcodeGateway->getPostcodesFromCsvs();
        $postcodeController = new PostcodeController();
        $postcodeController->updatePostcodes($postcodes);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
