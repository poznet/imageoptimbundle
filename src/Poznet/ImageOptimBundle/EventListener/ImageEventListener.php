<?php
/**
 * Created by PhpStorm.
 * User: pozyc
 * Date: 30.10.2017
 * Time: 11:42
 */

namespace Poznet\ImageOptimBundle\EventListener;


use Doctrine\ORM\EntityManager;
use Poznet\ImageOptimBundle\Entity\Image;
use Poznet\ImageOptimBundle\Event\ImageEvent;
use Tinify\Tinify;

class ImageEventListener
{
    private $em;
    private $apikey;

    /**
     * ImageEventListener constructor.
     * @param $em
     */
    public function __construct(EntityManager $em, $api)
    {
        $this->em = $em;
        $this->apikey = $api;
        Tinify::setKey($this->apikey);
    }

    public function onMinify(ImageEvent $event)
    {
        $image = $event->getImage();
        $object = $event->getObject();
        if (!file_exists($image->getPathname()))
            return;
        \Tinify\fromFile($object->getPath())->toFile($object->getPath());
        $object->setMinfied(true);
        $object->setFIleInfo();
        $this->em->flush();


    }

    public function onAdd(ImageEvent $event)
    {
        $image = $event->getImage();
        if (!file_exists($image->getPathname()))
            return;

        $img = $this->em->getRepository("PoznetImageOptimBundle:Image")->findOneByPath($image->getPathname());
        if (!$img) {
            $img = new Image();
            $img->setPath($image->getPathname());
            $this->em->persist($img);
            $this->em->flush();
        } else {
            //file exists in db
            if ($img->getMinfied() === true) {
                if (filectime($image->getPathname()) > $img->getFiledate()) {
                    $img->setMinified(false);
                }

            }
        }

    }

}

