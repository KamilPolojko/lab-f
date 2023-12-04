<?php

/** @var \App\Model\ShoppingList $shoppingList */
/** @var \App\Service\Router $router */

$title = "Edit Post {$shoppingList->getTitle()} ({$shoppingList->getId()})";
$bodyClass = "edit";

ob_start(); ?>
    <h1><?= $title ?></h1>
    <form action="<?= $router->generatePath('list-edit') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="list-edit">
        <input type="hidden" name="id" value="<?= $shoppingList->getId() ?>">
    </form>

    <ul class="action-list">
        <li>
            <a href="<?= $router->generatePath('list-index') ?>">Back to list</a></li>
        <li>
            <form action="<?= $router->generatePath('list-delete') ?>" method="post">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                <input type="hidden" name="action" value="list-delete">
                <input type="hidden" name="id" value="<?= $shoppingList->getId() ?>">
            </form>
        </li>
    </ul>

<?php $mainn = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
