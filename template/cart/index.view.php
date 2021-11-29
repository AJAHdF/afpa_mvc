<?php $cartTotalPrice = 0; ?>
<?php foreach($cart_lines as $line){
    $cartTotalPrice += $line->price;
?>
    <?= $line->product->name ?> x <?= $line->quantity ?> : <?= $line->price ?> € <br>
<?php }?>
<b><u>Total Panier :</u> <?= $cartTotalPrice ?>€</b>
<hr>
<a href="/cart/command">Commander</a>