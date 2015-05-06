<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Classes;
use DibiConnection;
/**
 * Description of Linestring
 *
 * @author Garfield
 */
class Linestring extends Geometry {
    //put your code here
    
    /**
     *
     * @var Point[]
     */
    private $points;


    public function __construct($points) {
	$this->type = 'LINESTRING';
	$this->points = $points;
    }
    
    public function addPoint(Point $point) {
	$this->points[] = $point;
    }
    
    public function addPoints($points) {
	if (is_array($point)) {
	    foreach ($points as $point) 
		$this->points[] = $point;
	} else {
	    throw new Exception('points must be array of Point', 3001);
	} 	
    }


    public function makeString(DibiConnection $connection) {		
	return $connection->query("SELECT ST_MakeLine(ST_GeomFromText('LINESTRING(".join(",",$this->points).")',4326));")->fetch()->st_makeline;	
    }
    
    public function getDistance(DibiConnection $connection) {
	return $connection->query("SELECT ST_Length(ST_GeomFromText('LINESTRING(".join(",",$this->points).")',4326),false);")->fetch()->st_length;	
    }
}
