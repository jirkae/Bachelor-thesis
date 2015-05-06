<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Classes;

/**
 * Description of Parser
 *
 * @author Garfield
 */
class Parser extends \Nette\Object {
    //put your code here
    
    public function __construct() {
	
    }
    


    public function makePathFromGmxFile($content,$type,$connection) {
	$xml=@simplexml_load_string($content) or die("Error: Cannot create object");	    
	
	$points = array();
	
	$lastEle = 0;
	$elevation = 0;
	foreach ($xml->trk->trkseg as $trkseg) {
	    if (isset($trkseg)) {
		foreach ($trkseg as $line) {
		    $attrs = array();
		    foreach ($line->attributes() as $key => $val)
			$attrs[$key] = $val;
		    if ((int)$line->ele >  $lastEle && $lastEle != 0)
			$elevation += (int)$line->ele - $lastEle;
		    $lastEle = (int)$line->ele;
		    
		    $points[] = new \Model\Classes\Point($attrs['lon'], $attrs['lat']);
		}
	    }
	}
	
	
	$line = new \Model\Classes\Linestring($points);
	$lineString = $line->makeString($connection);
	$distance = $line->getDistance($connection);
	
	$path = new Path(null, 'test', $type, $lineString, $distance,$elevation);
	return $path;
    }
}
