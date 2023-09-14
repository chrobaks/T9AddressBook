<?php $View = $View ?? []; ?>

<?php if(isset ($View["msgError"]) && $View["msgError"] !== ""):?>
    <div><b>Fehlermeldung</b><br><p><?=$View["msgError"];?></p></div>
<?php endif;?>
<?php if(isset ($View["msgInfo"]) && $View["msgInfo"] !== ""):?>
    <div><b>Information</b><br><p><?=$View["msgInfo"];?></p></div>
<?php endif;?>
