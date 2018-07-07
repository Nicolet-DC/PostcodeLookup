<?php

namespace App\Entity;

use App\Utils\GeoConversion;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostcodeRepository")
 */
class Postcode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $postcode;

    /**
     * @ORM\Column(type="integer")
     */
    private $easting;

    /**
     * @ORM\Column(type="integer")
     */
    private $northing;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    public function getId()
    {
        return $this->id;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(int $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getEasting(): ?int
    {
        return $this->easting;
    }

    public function setEasting(int $easting): self
    {
        $this->easting = $easting;

        return $this;
    }

    public function getNorthing(): ?int
    {
        return $this->northing;
    }

    public function setNorthing(int $northing): self
    {
        $this->northing = $northing;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public static function fromCsv(string $postcode, int $easting, int $northing):Postcode
    {
        $entity = new Postcode();
        $entity->setPostcode($postcode);
        $entity->setEasting($easting);
        $entity->setNorthing($northing);
        $entity->setLatitude(GeoConversion::toLatitude($easting));
        $entity->setLongitude(GeoConversion::toLongitude($northing));
        return $entity;
    }
}
