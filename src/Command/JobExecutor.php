<?php

namespace App\Command;

use App\Api\Api;
use App\Converter\XMLConverter;
use App\Hook\JobHook;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JobExecutor extends Command{
    protected function configure(){
        $this->setName('job-executor');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '<info>API Envoie format XML</info>',
            '============',
            '',
        ]);
        $formatter     = new JobHook();
        $formatted_ads = [];
        $filepath      = "data/job.xml";
        $ads           = XMLConverter::xmlToArray($filepath);

        foreach ($ads as $ad) {
            // format and send ads
           $formatted_ads = $formatter->formatAd($ad);
            Api::send($formatted_ads,'job');
        }

            print_r($formatted_ads);

        return 0;
    }
}
