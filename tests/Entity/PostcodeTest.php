<?php
namespace App\Tests\Entity;

use App\Entity\Postcode;
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
    }
}