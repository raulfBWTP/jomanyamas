<div class="giftListing rounded shadowed border1">
    <table class="textTable">
        <tr >
            <td width=90 class="textTable" style="text-align:center;width:130px;"
                onclick="showGiftDetail( <?=$id?>, '<?=$name?>', '<?=$description?>', '<?=$filename?>')">
                <img class="giftImage" alt="<image>" src="temp/<?=$filename?>" >
            </td>
            <td width=150 class="textTable" 
                style="vertical-align:top;" onclick="showGiftDetail( <?=$id?>, '<?=$name?>', '<?=$description?>', '<?=$filename?>')">
                <div class="giftText">
                <div class="giftName"><?=$name?></div>
                <div class="giftDescription"> <?=$description?></div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="noborder align-right nopadding" colspan = "2">
        <button onclick="showDiv('swap_<?=$id?>')"> Swap...</button>
            
            </td>
        </tr>
    </table>
    <div class="confirm"  id="swap_<?=$id?>">
        <div class="dimmer">&nbsp;</div>
        <div class="swapPopup">
            <form action="gift_inventory.php"  method="POST">
                <input type="hidden" name="action" value="swap">
                <input type="hidden" name="gift_id" value="<?=$id?>">
            <?php
                include("player_popup.php");
            ?>
            </form>
        </div>
    </div>

</div>