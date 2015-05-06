<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Classes;

/**
 * Description of Point
 *
 * @author Garfield
 */
class Point {
    //put your code here
    /**
     *
     * @var float 
     */
    private $x;
    /**
     *
     * @var float 
     */
    private $y;
    
    /**
     * 
     * @param float $x
     * @param float $y
     * @param float $z
     */
    public function __construct($x,$y) {
	$this->x = $x;
	$this->y = $y;	
    }
    
    public function __toString() {
	return $this->x." ".$this->y;
    }
}
