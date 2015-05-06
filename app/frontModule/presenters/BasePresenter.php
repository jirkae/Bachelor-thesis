<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\FrontModule\Presenters;

/**
 * Description of BasePresenter
 *
 * @author Garfield
 */
class BasePresenter extends \App\Presenters\BasePresenter {
    //put your code here
    use \Kdyby\Autowired\AutowireProperties;
    use \Kdyby\Autowired\AutowireComponentFactories;

    /**
     * @autowire
     * @var \Model\Services\PathRepository
     */
    protected $pathRepository;
    
    /**
     * @autowire
     * @var \DibiConnection
     */
    protected $connection;
}
