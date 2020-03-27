<?php
namespace App\Entity;


use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Validator\Constraints\Date;

class EventSearch {

    /**
     * @var string|null
     */
    private $texte;

    /**
     * @var object|null
     */
    private $categories;

    /**
     * @var object|null
     */
    private $cities;

    /**
     * @var integer|null
     */
    private $distance;

    /**
     * @var Date|null
     */
    private $start;

    /**
     * @var Date|null
     */
    private $end;

    /**
     * @return string|null
     */
    public function getTexte(): ?string
    {
        return $this->texte;
    }

    /**
     * @param string|null $texte
     *
     * @return EventSearch
     */
    public function setTexte(string $texte): EventSearch
    {
        $this->texte = $texte;
        return $this;
    }

    /**
     * @return object|null
     */
    public function getCategories(): ?object
    {
        return $this->categories;
    }

    /**
     * @param object|null $categories
     *
     * @return EventSearch
     */
    public function setCategories(object $categories): EventSearch
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return object|null
     */
    public function getCities(): ?object
    {
        return $this->cities;
    }

    /**
     * @param object|null $cities
     *
     * @return EventSearch
     */
    public function setCities(object $cities): EventSearch
    {
        $this->cities = $cities;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     *
     * @return EventSearch
     */
    public function setDistance(int $distance): EventSearch
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @return Date|null
     */
    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    /**
     * @param \DateTimeInterface $start
     *
     * @return EventSearch
     */
    public function setStart(?\DateTimeInterface $start): EventSearch
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return Date|null
     */
    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    /**
     * @param \DateTimeInterface $end
     *
     * @return EventSearch
     */
    public function setEnd(?\DateTimeInterface $end): EventSearch
    {
        $this->end = $end;
        return $this;
    }


}