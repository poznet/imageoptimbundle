<?php
/**
 * Created by PhpStorm.
 * User: pozyc
 * Date: 30.10.2017
 * Time: 11:38
 */

namespace Poznet\ImageOptimBundle\Event;


use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Finder\SplFileInfo;

class ImageEvent extends Event
{

    private $image;
    private $object;

    /**
     * ImageEvent constructor.
     * @param $image
     */
    public function __construct(SplFileInfo $image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage(SplFileInfo $image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }




}
