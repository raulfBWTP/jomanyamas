<div class="giftListing rounded border1 shadowed">
    <table class="textTable">
        <tr >
            <td width=90 class="textTable" style="text-align:center;width:130px;" >
                <img class="giftImage" alt="<image>" src="temp/<?=$filename?>" >
            </td>
            <td width=150 class="textTable" 
                style="vertical-align:top;">
                <div class="giftText">
                <div class="giftName futura"><?=$name?></div>
                <div class="giftDescription"> <?=$description?></div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="noborder nopadding"></td>
            <td class="noborder nopadding">
                <form class="nopadding align-right"  action="gift_inventory.php" method="POST">
                    <input type="hidden" name="action" value="claim">
                    <input type="hidden" name="gift_id" value="<?=$id?>">
                    <input type="hidden" name="player_id" value="<?=$player_id?>">
                    <button type="submit">I want this prize!</button>
                </form>
            </td>
        </tr>
    </table>
</div>
