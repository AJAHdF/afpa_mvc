<?php

class Customer extends Model {
    // cette syntaxe est personnelle (la relation est utilisé dans tableau associatif)
    static $relations =
    [
        "User" => ['type'=>'isOne',
                         'table' => 'app_user',
                         'attribute' => 'user',
                         'foreignKey' =>'customer_id'],
    
        "Commands" => ['type'=>'hasMany', 
                    'table'=>'command', 
                    'attribute'=>'commands', 
                    'foreignKey'=>'customer_id']
    ];
    
}