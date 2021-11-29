<?php

class Model {

    function __construct($fields = []){
        foreach($fields as $k => $v){
            $this->{$k} = $v;
        }
    }
    
}