<?php

namespace App\Command;

use App\Api\Api; /* todo revoir use use App\Validator\Api; */
use App\Converter\JsonConverter;
use App\Hook\RealEstateHook;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RealEstateExecutor extends Command
{
    protected function configure(){
        $this->setName('real-estate-executor');
        $this->formatter = new RealEstateHook();
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $formatted_ads = [];
        $filepath      = "data/real_estate.json";
        $ads           = JsonConverter::jsonToArray($filepath);

        foreach ($ads as $ad) {
            // format and send ads
            $formatted_ads = RealEstateHook::formatAd($ad);
            Api::send($formatted_ads,"real_estate");
        }

        print_r($formatted_ads);

        return 0;
    }
}
