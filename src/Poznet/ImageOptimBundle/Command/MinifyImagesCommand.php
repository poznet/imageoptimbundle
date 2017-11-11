<?php
/**
 * Created by PhpStorm.
 * User: pozyc
 * Date: 30.10.2017
 * Time: 14:12
 */

namespace Poznet\ImageOptimBundle\Command;


use Poznet\ImageOptimBundle\Event\ImageEvent;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\SplFileInfo;


class MinifyImagesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('image:optim:minify')
            ->setDescription('Minify Images ')
            ->addArgument('count', InputArgument::OPTIONAL, 'How many images  you want to optimize - default is 20');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('Start...');
        $em = $this->getContainer()->get("doctrine.orm.entity_manager");
        $limit = 20;
        if ($input->hasArgument('count'))
            $limit = $input->getArgument('count');
        $images = $em->getRepository("PoznetImageOptimBundle:Image")->findBy(['minfied' => false], [], $limit);

        foreach ($images as $image) {
            $output->writeln($image->getPath());

            $file = new SplFileInfo($image->getPath(), $image->getPath(), $image->getPath());
            $event = new ImageEvent($file);
            $event->setObject($image);
            $this->getContainer()->get('event_dispatcher')->dispatch('image.minify', $event);
        }

    }


}

