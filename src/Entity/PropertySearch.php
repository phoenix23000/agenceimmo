<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch{
    /**
     * @var int|null
     */
    private $maxPrice;
    /**
     * @var int|null
     * @Assert\Range(min=10,max=400)
     */
    private $minSurface;
    /**
     * @var ArrayCollection
     */
    private $options;
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }
    /**
     * Get the value of minSurface
     *
     * @return  int|null
     */ 
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @param  int|null  $minSurface
     *
     * @return  PropertySearch
     */ 
    public function setMinSurface($minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of maxPrice
     *
     * @return  int|null
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @param  int|null  $maxPrice
     *
     * @return  PropertySearch
     */ 
    public function setMaxPrice($maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
    

    /**
     * Get the value of options
     *
     * @return  ArrayCollection
     */ 
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @param  ArrayCollection  $options
     *
     * @return  self
     */ 
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }
}