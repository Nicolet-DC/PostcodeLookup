<?php

namespace App\Utils;

use PHPCoord\LatLng;
use PHPCoord\OSRef;

abstract class GeoConversion
{

    public static function toLatLng(int $easting, int $northing):LatLng
    {
        $OSRef = new OSRef($easting, $northing);
        return $OSRef->toLatLng();
    }

    public static function toLatitude(int $easting):float
    {
        $OSRef = new OSRef($easting, 0);
        return $OSRef->getOriginLatitude();
    }

    public static function toLongitude(int $northing):float
    {
        $OSRef = new OSRef(0, $northing);
        return $OSRef->getOriginLongitude();
    }
}