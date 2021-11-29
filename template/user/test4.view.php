<?php foreach($customers as $customer){ ?>
    <?=$customer->firstname ?><br>
    <?=$customer->user->login ?>
<?php } ?>