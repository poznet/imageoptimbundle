<?php

namespace Poznet\ImageOptimBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table("image_optim_image")
 * @ORM\Entity(repositoryClass="Poznet\ImageOptimBundle\Entity\ImageRepository")
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="text")
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="filedate", type="string", length=255,nullable=true)
     */
    private $filedate;

    /**
     * @var string
     *
     * @ORM\Column(name="sizebefore", type="string", length=255,nullable=true)
     */
    private $sizebefore;

    /**
     * @var string
     *
     * @ORM\Column(name="sizeafter", type="string", length=255,nullable=true)
     */
    private $sizeafter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="minified", type="boolean")
     */
    private $minfied=false;

     

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->setFIleInfo();
        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set filedate
     *
     * @param \DateTime $filedate
     *
     * @return Image
     */
    public function setFiledate($filedate)
    {
        $this->filedate = $filedate;

        return $this;
    }

    /**
     * Get filedate
     *
     * @return \DateTime
     */
    public function getFiledate()
    {
        return $this->filedate;
    }

    /**
     * Set sizebefore
     *
     * @param string $sizebefore
     *
     * @return Image
     */
    public function setSizebefore($sizebefore)
    {
        $this->sizebefore = $sizebefore;

        return $this;
    }

    /**
     * Get sizebefore
     *
     * @return string
     */
    public function getSizebefore()
    {
        return $this->sizebefore;
    }

    /**
     * Set sizeafter
     *
     * @param string $sizeafter
     *
     * @return Image
     */
    public function setSizeafter($sizeafter)
    {
        $this->sizeafter = $sizeafter;

        return $this;
    }

    /**
     * Get sizeafter
     *
     * @return string
     */
    public function getSizeafter()
    {
        return $this->sizeafter;
    }

    /**
     * Set minfied
     *
     * @param boolean $minfied
     *
     * @return Image
     */
    public function setMinfied($minfied)
    {
        $this->minfied = $minfied;

        return $this;
    }

    /**
     * Get minfied
     *
     * @return boolean
     */
    public function getMinfied()
    {
        return $this->minfied;
    }

    /**
     * @param $path
     */
    public function setFIleInfo( )
    {
        if (file_exists($this->path)) {
            $this->setSizebefore(filesize($this->path));
            $this->setFiledate(filectime($this->path));
        }
    }
}
