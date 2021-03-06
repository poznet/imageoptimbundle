<?php
/**
 * Created by PhpStorm.
 * User: pozyc
 * Date: 30.10.2017
 * Time: 12:47
 */

namespace Poznet\ImageOptimBundle\Command;


use Poznet\ImageOptimBundle\Event\ImageEvent;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class ScanImagesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('image:optim:scan')
            ->setDescription('Searches for  images ')
            ->addArgument('count', InputArgument::OPTIONAL, 'How many dirs  you want to check 500 is default');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $limit = 500;
        if ($input->hasArgument('count'))
            $limit = $input->getArgument('count');
        $dirs = $this->getContainer()->getParameter('imageoptim_dirs');
        $excluded = $this->getContainer()->getParameter('imageoptim_excluded');
        $root = $this->getContainer()->get("kernel")->getRootDir();
        $finder = new Finder();
        $finder->files()->name('*.jpg')->name('*.png');
        foreach ($dirs as $dir)
            $finder->in($root . '/../' . $dir);
        foreach ($excluded as $ex)
            $finder->exclude($ex);

        if ($input->hasArgument('count')) {
            $finder = iterator_to_array($finder);
            shuffle($finder);
        }
        $i=1;
        foreach ($finder as $file) {
            $i++;
            $output->writeln($file->getPathname());
            $event = new ImageEvent($file);
            $this->getContainer()->get('event_dispatcher')->dispatch('image.add', $event);
            if(($i>$limit)&&$input->hasArgument('count'))
                break;
        }
    }
}

