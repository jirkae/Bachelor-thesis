<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Classes;
/**
 * Description of Path
 *
 * @author Garfield
 */
class Path {

    /**
     * @var int
     */
    private $id;
    
    /**
     *
     * @var String
     */
    private $name;
    
    /**
     *
     * @var Type
     */
    private $type;
        
    
    private $geometry;
    
    private $distance;
    
    private $elevation;
    
    public function __construct($id,$name,$type,$geometry,$distance,$elevation) {
	$this->id = $id;
	$this->name = $name;
	$this->type = $type;
	$this->geometry = $geometry;
	$this->distance = $distance;
	$this->elevation = $elevation;
    }
    
    public function save(\DibiConnection $connection) {
	$data = array(
	    'the_geom' => $this->geometry,
	    'bin' => 0,
	    'distance' => (int)$this->distance,
	    'elevation' => (int)$this->elevation,
	    'type' => $this->type
	);
	$connection->insert('paths', $data)->execute();
    }

    
}
