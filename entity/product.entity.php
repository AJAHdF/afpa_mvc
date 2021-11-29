<?php

class Product extends Model {
    // cette syntaxe est personnelle (la relation est utilisé dans tableau associatif)
    static $relations =
        ["Category" => ['type'=>'hasOne',
                         'table' => 'category',
                         'attribute' => 'category',
                         'foreignKey' =>'category_id']
        ];
}