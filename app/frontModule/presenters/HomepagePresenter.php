<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\FrontModule\Presenters;

use Nette\Application\UI\Form;
/**
 * Description of HomepagePresenter
 *
 * @author Garfield
 */
class HomepagePresenter extends BasePresenter {
    //put your code here
    
    public function renderMap() {	
	$this->template->filters = $this->getParameter('filters');
    }
    
    public function renderUpload() {
	//$this->connection->select("ST_MakeLine(ST_GeomFromText('LINESTRING(14.40234174951911 50.017309631220996,14.403668101876974 50.01691727433354,14.40849456936121 50.016191778704524,14.41301241517067 50.01683115027845,14.416598780080676 50.01510112546384,14.417332280427217 50.014222827740014,14.418903887271881 50.01388143282384,14.418619321659207 50.01384166069329,14.418409941717982 50.013731103390455,14.418409941717982 50.32225,14.17982 50.01373,14.40849456936121 50.016191778704524,14.41301241517067 50.01683115027845,14.416598780080676 50.01510112546384,14.417332280427217 50.014222827740014,14.418903887271881 50.01388143282384,14.418619321659207 50.01384166069329,14.418409941717982 50.013731103390455,14.418409941717982 50.32225,14.17982 50.01373)',4326))")->execute();
    }

    public function createComponentUpload() {
	$form = new Form;
	$form->addRadioList('type',"Typ",array(1=>'kolo',2=>'brusle',3=>'pěšky'))->setRequired();
	$form->addUpload('file');
	$form->addSubmit('save','Uložit');
	$form->onSuccess[] = array($this,'save');
	return $form;
    }
    
    public function save(Form $form) {
	$values = $form->getValues();	
	
	
	
	if ($values->file->isOk()) {
	    $parser = new \Model\Classes\Parser;
	    $path = $parser->makePathFromGmxFile($values->file->getContents(), $values->type,  $this->connection);
	    $path->save($this->connection);
	}
	
	$this->redirect('this');
    }
    
    
    public function createComponentFilters() {
	$form = new Form;
	$form->addRadioList('type',"Typ",array(1=>'kolo',2=>'brusle',3=>'pěšky'));
	$form->addText('distance_from','Vzdálenost od (km)');
	$form->addText('distance_to','Vzdálenost do (km)');
	$form->addText('elevation_from','Celkové převýšení od (m)');
	$form->addText('elevation_to','Celkové převýšení do (m)');
	$form->addText('area','Oblast');
	$form->addSubmit('apply',"Aplikovat");
	if ($this->getParameter('filters') != null) {
	    $form->setDefaults($this->getParameter('filters'));
	}
	$form->onSuccess[] = array($this,'applyFilters');
	return $form;
    }
    
    public function applyFilters(Form $form) {
	$values = $form->getValues();
	if (!empty($values->area)) {
	    $googleResponse = json_decode(file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.str_replace(' ', '%20', $values->area).'&sensor=false&language=cs'));
	    if (!empty($googleResponse->results)) {
		$values->center = $googleResponse->results[0]->geometry->location->lng.",".$googleResponse->results[0]->geometry->location->lat;
	    }
	}
	$this->redirect('this',array('filters'=>$values));
    }
}
