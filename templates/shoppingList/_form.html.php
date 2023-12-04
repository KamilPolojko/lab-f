<?php
    /** @var $shoppingList ?\App\Model\ShoppingList */
?>

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" id="title" name="shoppingList[title]" value="<?= $shoppingList ? $shoppingList->getTitle() : '' ?>">
</div>


<div class="form-group">
    <label></label>
    <input type="submit" value="Submit">
</div>
