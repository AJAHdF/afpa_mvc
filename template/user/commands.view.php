<?php foreach($commands as $command){ 
    $totalCommand = 0; 
?>
    <u><b>Commande N° <?= $command->number ?></b></u><br>
    <?php foreach($command->lines as $line){ 
        $totalCommand += $line->price; 
    ?>
        <?= $line->product->name ?> x <?= $line->quantity ?> : <?= $line->price ?> € <br>
    <?php } ?>  
    <u>Total Commande :</u> <b><?= $totalCommand ?>€</b>
    <hr>
<?php } ?>