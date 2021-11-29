<?php

class CategoryController extends BaseController{
   
    function index(){
        $repository = new MainRepository("category");
        $categories = $repository->getAll();
        $this->entities =['categories'=> $categories];
        $this->render();
    }

    function read(){
        $repository = new MainRepository("category");
        $repository->with("Products");
        $category = $repository->getOne($this->id);
        if($category == null){
         header("Location: /error404");
         die;
         }
        // $repository = new MainRepository("product");
        // $products = $repository->getAll("category_id = $this->id");
        $this->entities =['category'=> $category]; //, 'products'=> $products];
        $this->render();
    }
}
?>