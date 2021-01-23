<div class="giftListing rounded border1 shadowed">
    <table class="textTable">
        <tr >
            <td width=90 class="textTable" style="text-align:center;width:130px;"
                onclick="showGiftDetail( <?=$id?>, '<?=$name?>', '<?=$description?>', '<?=$filename?>')">
                <img class="giftImage" alt="<image>" src="temp/<?=$filename?>" >
            </td>
            <td width=150 class="textTable" 
                style="vertical-align:top;" onclick="showGiftDetail( <?=$id?>, '<?=$name?>', '<?=$description?>', '<?=$filename?>')">
                <div class="giftText">
                <div class="giftName futura"><?=$name?></div>
                <div class="giftDescription"> <?=$description?></div>
                </div>
            </td>
                        <?php
            // If it's raul so show include column
            if ($username == "raul")  {
                $is_checked =  ($include == 1) ? "checked" : " ";
                $toggle = 1 - $include;
            ?>
           <td style="border:0px;"><input type="checkbox" name="enable" value="1" <?= $is_checked ?> onclick="toggleGiftInclude(<?=$id?>, <?=$toggle?>)"></td>
            <?php
            }
            ?>

            <td class="textTable" style="text-align:right;vertical-align:center;">
<?php
if ( $creator == $player_id) {
?>
            <form action="all_gifts.php" method="POST">
                <button type="submit">Delete</button>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="gift_id" value="<?=$id?>">
                <input type="hidden" name="player_id" value="<?=$player_id?>">
                </form>
<?php
}                
?>
            </td>
        </tr>
    </table>
</div>
