<?php

class Cart
{
    private static $_instance = null;
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Cart();
        }
 
        return self::$_instance;
    }
 
    private function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $customer_id = null;
            if (isset($_SESSION['logged'])) {
                $logged = unserialize($_SESSION['logged']);
                $customer_id = $logged->customer_id;
            }
            $command = new Command(['customer_id'=>$customer_id]);
            $_SESSION['cart'] = ['command' => serialize($command),
                             'lines' => serialize([])];
        }
    }

    function getCommand(){
        return unserialize($_SESSION['cart']['command']);
    }

    function getLines(){
        return unserialize($_SESSION['cart']['lines']);
    }

    function reset(){
        unset($_SESSION['cart']);
        $customer_id = null;
        if (isset($_SESSION['logged'])) {
            $logged = unserialize($_SESSION['logged']);
            $customer_id = $logged->customer_id;
        }
        $command = new Command(['customer_id'=>$customer_id]);
        $_SESSION['cart'] = ['command' => serialize($command),
                            'lines' => serialize([])];
    }

    function addOrUpdateLine($product_id, $quantity){
        $cart_lines = unserialize($_SESSION['cart']['lines']);

        $exists = false;
        foreach($cart_lines as $line){
            if($line->product_id == $product_id){
                $line->quantity += $quantity;
                $line->price += $quantity * $line->product->price;
                $exists = true;
                break;
            }
        }
        if(!$exists){
            $repo = new MainRepository('product');
            $product = $repo->getOne($product_id);
            $line = new Command_product(['product_id' => $product_id,
                                            'quantity'   => $quantity, 
                                            'price'      => $quantity * $product->price,
                                            'product'    => $product]);
            array_push($cart_lines, $line);
        }

        $_SESSION['cart']['lines'] = serialize($cart_lines);
    }

    
}