<?php

namespace App\Services;

use Location\Coordinate;
use Location\Polyline;
use Location\Distance\Vincenty;
use Location\Polygon;

class GeoService{

    public function between(){

        $coordinate1 = new Coordinate(19.820664, -155.468066); // Mauna Kea Summit
        $coordinate2 = new Coordinate(20.709722, -156.253333); // Haleakala Summit

        $calculator = new Vincenty();
        // $coordinate1 = new Coordinate(19.820664, -155.468066); // Mauna Kea Summit
        // $coordinate2 = new Coordinate(20.709722, -156.253333); // Haleakala Summit


        return $calculator->getDistance($coordinate1, $coordinate2); // returns 128130.850 (meters; ≈128 kilometers)
    }

    public function polyline(){
        $polyline = new Polyline();
        $polyline->addPoint(new Coordinate(10.0, 10.0));
        $polyline->addPoint(new Coordinate(20.0, 20.0));
        $polyline->addPoint(new Coordinate(30.0, 10.0));

        $processor = new Simplify($polyline);

        // remove all points which perpendicular distance is less
        // than 1500 km from the surrounding points.
        $simplified = $processor->simplify(1500000);

        // simplified is the polyline without the second point (which

        return $simplified;
    }

    public function Polygon(){

        $geofence = new Polygon();

        $geofence->addPoint(new Coordinate(-12.085870,-77.016261));
        $geofence->addPoint(new Coordinate(-12.086373,-77.033813));
        $geofence->addPoint(new Coordinate(-12.102823,-77.030938));
        $geofence->addPoint(new Coordinate(-12.098669,-77.006476));

        $outsidePoint = new Coordinate(-12.075452, -76.985079);
        $insidePoint = new Coordinate(-12.092542, -77.021540);

        var_dump($geofence->contains($outsidePoint)); // returns bool(false) the point is outside the polygon
        var_dump($geofence->contains($insidePoint)); // returns bool(true) the point is inside the polygon


        return [
            $geofence->contains($outsidePoint),           
            $geofence->contains($insidePoint)         
        ];
    }

    public function geoJSON(){
        $coordinate = new Coordinate(18.911306, -155.678268); // South Point, HI, USA

        return  $coordinate->format(new GeoJSON()); // { "type" : "point" , "coordinates" : [ -155.678268, 18.911306 ] }
    }

}