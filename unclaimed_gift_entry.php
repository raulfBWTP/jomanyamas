<div class="giftListing rounded border1">
    <table class="textTable">
        <tr >
            <td width=90 class="textTable" style="text-align:center;width:130px;" >
                <img class="giftImage" alt="<image>" src="temp/<?=$filename?>" >
            </td>
            <td width=150 class="textTable" 
                style="vertical-align:top;">
                <div class="giftText">
                <div class="giftName"><?=$name?></div>
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
        </tr>
    </table>
</div>
