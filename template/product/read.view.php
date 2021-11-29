<h1>
    Detail du produit <?= $product->name ?>
</h1>
<h2>
   Categorie du produit  <?=$product->category->name ?> 
  </h2>
<h4>
    Descripton du produit <?= $product->description ?>
</h4>
<h4>
    Prix : <?= $product->price?>
</h4>
<div>
    <img alt ="<?= $product->name ?>" src="<?= $product->image_path ?? ''?>" />
</div>
<br>
<a href="/product/update/<?= $product->id?>" class="btn btn-sm btn-success mb-3">
Modifier
</a>
<br>
<form action="/cart/add/<?= $product->id ?>" method="post">
    <input type="number" name="quantity" id="quantity" value="1" min="1" max="9" step="1" >
    <input type="submit" name="addToCart" id="addToCart" value="+" class="btn btn-sm btn-primary mb-1">
</form>