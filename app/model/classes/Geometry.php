<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Classes;
/**
 * Description of Geometry
 *
 * @author Garfield
 */
class Geometry extends \Nette\Object {
    //put your code here    
    
    protected $type;
    
    public function getType() {
	return $this->type;
    }
    
    public function setType($type) {
	$this->type = $type;
    }
}
