<h1>
    détail de la categorie : <?= $category->name ?>
</h1>
<h2>
    Produits de cette catagorie :
</h2>

<ul>
    <?php
        foreach ($category->products as $product) {
            ?>
             <li>
                 <?= $product->name ?>
             </li>
         <?php    
             }
        ?>
</ul>
