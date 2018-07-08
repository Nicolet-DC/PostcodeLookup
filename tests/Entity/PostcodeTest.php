<?php
namespace App\Tests\Entity;

use App\Entity\Postcode;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use PHPUnit\Framework\TestCase;

class PostcodeTest extends TestCase
{
    public function testCreateValidPostcodeFromCsv():void
    {
        $postcodeValue = 'BH11 1AA';
        $easting = 409722;
        $northing = 92041;
        $postcode = Postcode::fromCsv($postcodeValue, $easting, $northing);
        $this->assertSame($postcodeValue, $postcode->getPostcode());
        $this->assertSame($easting, $postcode->getEasting());
        $this->assertSame($northing, $postcode->getNorthing());
        $this->assertSame(49.0, $postcode->getLatitude());
        $this->assertSame(-2.0, $postcode->getLongitude());
        $this->assertSame(49.0, $postcode->getPoint()->getLatitude());
        $this->assertSame(-2.0, $postcode->getPoint()->getLongitude());
    }
}