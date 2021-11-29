<?php

class Category extends Model {
// cette syntaxe est personnelle
static $relations=
    ["Products" => ['type'=>'hasMany',
                  'table' =>'product',
                  'attribute' =>'products',
                  'foreignKey'=>'category_id']
    ];
    
    }
