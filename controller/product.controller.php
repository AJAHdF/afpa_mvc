<?php

// require_once 'base.controller.php';
// require_once $_SERVER['DOCUMENT_ROOT']. '/repository/main.repository.php';
// require_once $_SERVER['DOCUMENT_ROOT']. '/entity/product.entity.php';

class ProductController extends BaseController{

    function read(){
        $repository = new MainRepository("product");
        $repository->with("Category");
        $product = $repository->getOne($this->id);
        if($product == null){
            header("Location: /error404");
            die;
        }
        // $repository = new MainRepository("category");
        // $category = $repository->getOne($product->category_id);
        $this->entities =['product'=> $product]; //, 'category'=> $category];
        $this->render();
    }

    function index(){       
        //* réquete sur la table product
        // $sql ="SELECT * FROM product";
        // $products = $db->query($sql)->fetchAll(PDO::FETCH_OBJ);
        // $this->entities =['products' => $products];
        // $this->render();

        $repo = new MainRepository("product");
        $products = $repo->getAll();
        $this->entities =['products' => $products];
        $this->render();
    }

    function create(){
        $errors = [];
        $posted = [];
        
        if(isset($_SESSION['post'])){
            
            $posted = $_SESSION['post'];
            unset($_SESSION['post']);
            $files = $_SESSION['files'];
            unset($_SESSION['files']);

            if(isset($posted['cancel'])){
                //TODO Delete temp image file if exists
                header("Location: /product");
                die;
            }

            if(isset($files['image_path']) && $files['image_path']['error'] == 0){
                $file = $files['image_path'];
                $posted['image_path'] = str_replace($_SERVER["DOCUMENT_ROOT"],"",str_replace("/temp","",$file['tmp_name']));

            }
            if(isset($posted['image_path'])){
                $temp_image_path = explode('/',$posted['image_path']);
                $indexToInsert = count($temp_image_path) - 1;
                array_splice( $temp_image_path, $indexToInsert, 0, "temp" );
                $temp_image_path = implode('/',$temp_image_path);
                $temp_image_path = $_SERVER["DOCUMENT_ROOT"].$temp_image_path;
            }
            
            $repo = new MainRepository("product");
            $errors = $repo->validate($posted);
            if(count($errors) == 0){
                $result = $repo->insertOne($posted);
                if($result != false){
                    if (isset($posted['image_path'])) {
                        $test = rename($temp_image_path, $_SERVER["DOCUMENT_ROOT"].$posted['image_path']);
                    }
                    header("Location: /product/read/$result->id");
                    die;
                }
            }
            
        }
        // il faut rechager les category de la liste box
        $repository = new MainRepository("category");
        $categories = $repository->getAll();
        $this->entities =['categories'=> $categories, 
                         'errors' => $errors , 
                         'posted' => $posted];
        $this->render();
    }

    function update(){

        $errors = [];
        $posted = [];

        $repository = new MainRepository("product");
        $product = $repository->getOne($this->id);
        foreach($product as $k => $v){
            $posted[$k] = $v;
        }

        if (isset($_SESSION['post'])) {
            foreach($_SESSION['post'] as $k => $v){
                $posted[$k] = $v;
            }
            unset($_SESSION['post']);
            $files = $_SESSION['files'];
            unset($_SESSION['files']);

            if (isset($posted['cancel'])) {
                //TODO Delete temp image file if exists
                header("Location: /product/read/$this->id");
                die;
            }

            if(isset($files['image_path']) && $files['image_path']['error'] == 0){
                $file = $files['image_path'];
                $posted['image_path'] = 
                    str_replace($_SERVER["DOCUMENT_ROOT"],"",str_replace("/temp","",$file['tmp_name']));
            }
            if(isset($posted['image_path'])){
                $temp_image_path = explode('/',$posted['image_path']);
                $indexToInsert = count($temp_image_path) - 1;
                array_splice( $temp_image_path, $indexToInsert, 0, "temp" );
                $temp_image_path = implode('/',$temp_image_path);
                $temp_image_path = $_SERVER["DOCUMENT_ROOT"] . $temp_image_path ;
            }
            
            $needToBeUpdated = false;
            foreach($posted as $k => $v){
                if(isset($product->{$k}) &&  $product->{$k} != $v){
                    $needToBeUpdated = true;
                    break;
                }
            }

            if($needToBeUpdated == true){
                $posted['id'] = $this->id;
                $errors = $repository->validate($posted);
                if(count($errors) == 0){
                    $result = $repository->updateOne($posted);
                    if($result != false){
                        if (isset($posted['image_path'])) {
                            $test = rename($temp_image_path, $_SERVER["DOCUMENT_ROOT"] . $posted['image_path']);
                        }
                        header("Location: /product/read/$this->id");
                        die;
                    }
                }
            }
            else{
                header("Location: /product/read/$this->id");
                die;
            }
        }

        $repository = new MainRepository("category");
        $categories = $repository->getAll();

        $this->entities = [ 'categories' => $categories, 
                            'errors' => $errors, 
                            'posted' => $posted ];

        $this->render();
    }
}