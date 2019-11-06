<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


class PropertySearch
{

    /**
     * @var int|null
     * */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min=9, max=600)
     * */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $specifications;

    public function __construct()
    {
        $this->specifications = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int|null $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSpecifications(): ArrayCollection
    {
        return $this->specifications;
    }

    /**
     * @param ArrayCollection $specifications
     * @return PropertySearch
     */
    public function setSpecifications(ArrayCollection $specifications): PropertySearch
    {
        $this->specifications = $specifications;
        return $this;
    }




}