<?php

/** @var \App\Model\ShoppingList $shoppingList */
/** @var \App\Service\Router $router */

$title = 'Create Post';
$bodyClass = "edit";

ob_start(); ?>
    <h1>Create List-Item</h1>
    <form action="<?= $router->generatePath('list-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="list-create">
    </form>

    <a href="<?= $router->generatePath('list-index') ?>">Back to list</a>
<?php $mainn = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
