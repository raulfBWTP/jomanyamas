<div id="addHolder">
    <div class="dimmer">
    &nbsp;
    </div>
    <div id="addForm" class="popup">
    <div class="instruction" >Type in the challenge...</div>
    <form action="jmas_entry.php" method="POST">
        <textarea id="newEntry" name="challenge_text" ></textarea><br>
        <input type="hidden" name="action" value="add">
        <div class="buttonHolder">
            <button name="submit" type="submit">
            Save
            </button>
            <button class="border1 purple" name="reset" type="reset" onclick="hideDiv('addHolder')">
            Cancel
            </button>
        </div>
    </form>
    </div>
</div>
