<?php

class Command_product extends Model
{

    static $relations = 
         [
            "Command" => ['type'=>'hasOne', 
                    'table'=>'command', 
                    'attribute'=>'command', 
                    'foreignKey'=>'command_id'],
     
            "Product" => ['type'=>'hasOne', 
                    'table'=>'product', 
                    'attribute'=>'product', 
                    'foreignKey'=>'product_id']             
        ];

}