<?php
    // require_once 'base.controller.php'; ==> cf spl_autoload de la classe MainRepository;
    // require_once $_SERVER['DOCUMENT_ROOT']. '/repository/main.repository.php';
    // require_once $_SERVER['DOCUMENT_ROOT']. '/entity/category.entity.php';

    class HomeController extends BaseController{
    
    function index(){
              
        $repository = new MainRepository("category");
        $categories = $repository->getAll();
        $this->entities =['categories' => $categories];
        $this->render();
        }
    }
?>