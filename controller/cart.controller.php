<?php

class CartController extends BaseController
{
    function index(){
        $cart = Cart::getInstance();
        $cart_lines = $cart->getLines();
        $this->entities = ['cart_lines' => $cart_lines];
        $this->render();
    }

    function add(){
        $redirect = $_SERVER['HTTP_REFERER'];
        $errors = [];
        $posted = [];

        if (isset($_SESSION['post'])) {
            $posted = $_SESSION['post'];
            unset($_SESSION['post']);

            $product_id = $this->id;
            $quantity = $posted['quantity'];

            $cart = Cart::getInstance();
            $cart->addOrUpdateLine($product_id, $quantity);
        }

        header("Location: $redirect");
        die;
    }

    function command(){
        if(!isset($_SESSION['logged'])){
            header('Location: /user/login');
            die;
        }
        $logged = unserialize($_SESSION['logged']);
        $customer_id = $logged->customer_id;
        $cart = Cart::getInstance();
        $command = $cart->getCommand();
        $command->customer_id = $customer_id;
        $cart_lines = $cart->getLines();
        $repo = new MainRepository('command');
        $fields = [];
        foreach($command as $k => $v){
            $fields[$k] = $v;
        }
        //TODO command.date //.state //.number
        $repo->validate($fields);
        $command = $repo->insertOne($fields);
        foreach($cart_lines as $line){
            $line->command_id = $command->id;
        }
        $repo = new MainRepository('command_product');
        $lines = [];
        foreach($cart_lines as $line){
            $lineFields = [];
            foreach($line as $k => $v){
                $lineFields[$k] = $v;
            }
            $repo->validate($lineFields);
            array_push($lines, $lineFields);
        }
        $result = $repo->insertMany($lines);
        if($result == true){
            $cart = Cart::getInstance();
            $cart->reset();
            header('Location: /user/commands');
            die;
        }
        header('Location: /cart');
        die;
    }

}