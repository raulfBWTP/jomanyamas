<?php
if ( $used == 0) {
    $onclick_value = "";
    $dimmed = "";
} else {
    $onclick_value = "";
    $dimmed = "dimmed";
}

?>
<div class="rounded border1 deckTile <?=$dimmed?>" onclick="<?=$onclick_value?>" style="float:left;">
    <?=$id?>
</div>
