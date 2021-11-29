<?php

class App_user extends Model {
    // cette syntaxe est personnelle (la relation est utilisé dans tableau associatif)
    static $relations =
        ["Customer" => ['type'=>'hasOne',
                         'table' => 'customer',
                         'attribute' => 'customer',
                         'foreignKey' =>'customer_id']
        ];
}