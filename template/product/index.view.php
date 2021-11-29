<h1>
    Liste des produits
</h1>
<a href="product/create" class="btn btn-sm btn-success mb-3">Nouveau Produit</a>
<ul>
    <?php
        foreach($products as $product){
            ?>
            <li>
                    <?=$product->name ?>
            </li>
    <?php
        }
    ?>
</ul>