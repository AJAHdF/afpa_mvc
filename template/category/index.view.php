<h1>
    Liste des categories
</h1>

<ul>
    <?php
        foreach($categories as $category) {
            ?>
             <li>
                 <a href="/category/read/<? $category->id?>"><?= $category->name ?></a>
             </li>
         <?php    
             }
        ?>
</ul>
