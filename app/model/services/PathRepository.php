<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Services;
use DibiConnection;
/**
 * Description of Repository
 *
 * @author Garfield
 */
class PathRepository extends \Nette\Object {
    //put your code here
    /**
     *
     * @var DibiConnection
     */
    private $connection;
    
    public function __construct(DibiConnection $connection) {
	$this->connection = $connection;	
    }
    
    public function test() {
	\Tracy\Debugger::barDump($this->connection->query("SELECT ST_MakeLine(ST_GeomFromText('LINESTRING(14.430059613659978 50.064414837397635,14.429805893450975 50.06434317212552,14.429481597617269 50.064256503246725,14.429315719753504 50.06411032285541,14.430096661671996 50.06387755740434)',4326));")->fetch());
    }
}
