<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostcodeRepository")
 * @ORM\Table(name="postcodes")
 *
 * Class Postcode
 * @package App\Entity
 */
class Postcode
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $postcode;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $eastings;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $northings;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * @return int
     */
    public function getEastings(): int
    {
        return $this->eastings;
    }

    /**
     * @param int $eastings
     */
    public function setEastings(int $eastings): void
    {
        $this->eastings = $eastings;
    }

    /**
     * @return int
     */
    public function getNorthings(): int
    {
        return $this->northings;
    }

    /**
     * @param int $northings
     */
    public function setNorthings(int $northings): void
    {
        $this->northings = $northings;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }
}