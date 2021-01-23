<?php
if  ($last_symbol != $symbol_id) {
?>
<div>
    Prizes in group <?=$symbol_id?>
</div>
<?php
}

?>
<div class="giftListing rounded border1 shadowed">
    <table class="textTable">
        <tr >
            <td width=90 class="textTable" style="text-align:center;width:130px;"
                onclick="showBrowseDetail( <?=$id?>, '<?=$name?>', '<?=$description?>', '<?=$filename?>')">
                <img class="giftImage" alt="<image>" src="temp/<?=$filename?>" >
            </td>
            <td width=150 class="textTable" 
                style="vertical-align:top;" onclick="showBrowseDetail( <?=$id?>, '<?=$name?>', '<?=$description?>', '<?=$filename?>')">
                <div class="giftText">
                <div class="giftName futura"><?=$name?></div>
                <div class="giftDescription"> <?=$description?></div>
                </div>
            </td>
        </tr>
    </table>
</div>
