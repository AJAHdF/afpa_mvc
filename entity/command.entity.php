<?php

class Command extends Model{

    static $relations = 
        [
            "Customer" => ['type'=>'hasOne', 
                        'table'=>'customer', 
                        'attribute'=>'customer', 
                        'foreignKey'=>'customer_id'],
            
            "Lines" => ['type'=>'hasMany', 
                     'table'=>'command_product', 
                     'attribute'=>'lines', 
                     'foreignKey'=>'command_id']
        ];
    
}