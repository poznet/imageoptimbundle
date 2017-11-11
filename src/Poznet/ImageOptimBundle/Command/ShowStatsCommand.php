<?php
/**
 * Created by PhpStorm.
 * User: pozyc
 * Date: 30.10.2017
 * Time: 14:12
 */

namespace Poznet\ImageOptimBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ShowStatsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('image:optim:stats')
            ->setDescription('Show stats ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $images = $this->getContainer()->get("doctrine.orm.entity_manager")->getRepository("PoznetImageOptimBundle:Image")->findAll();
        $processed = $this->getContainer()->get("doctrine.orm.entity_manager")->getRepository("PoznetImageOptimBundle:Image")->findBy(['minfied' => true]);
        $sumbefore = $this->getContainer()->get("doctrine.orm.entity_manager")->getRepository("PoznetImageOptimBundle:Image")->sumOfAllImages();
        $sum = 0;
        foreach ($processed as $img) {
            $sum += ($img->getSizebefore() - $img->getSizeafter());
        }
        $output->writeln("Images found : " . count($images));
        $output->writeln("Size of all Images : " . $this->filesizeFormatted($sumbefore));
        $output->writeln("Images minified : " . count($processed) . ' / ' . count($images));
        $output->writeln("Saved space : " . $this->filesizeFormatted($sum));


    }

    private function filesizeFormatted($size)
    {

        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

}

