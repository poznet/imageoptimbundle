<?php
/**
 * Created by PhpStorm.
 * User: pozyc
 * Date: 30.10.2017
 * Time: 13:32
 */

namespace Poznet\ImageOptimBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ClearAllImagesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('image:optim:truncate')
            ->setDescription('truncates all saved data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->getContainer()->get("doctrine.orm.entity_manager")->createQuery('DELETE PoznetImageOptimBundle:Image I')->execute();
        $output->writeln("All Images data was removed.");
    }

}

