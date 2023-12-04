<?php

/** @var \App\Model\ShoppingList[] $shoppingLists */
/** @var \App\Service\Router $router */

$title = 'Shopping List';
$bodyClass = 'index';

ob_start(); ?>
    <h1>Shopping List</h1>

    <a href="<?= $router->generatePath('list-create') ?>">Create new</a>

    <ul class="index-list">
        <?php foreach ($shoppingLists as $shoppingList): ?>
            <li><h3><?= $shoppingList->getTitle() ?></h3>
                <ul class="action-list">
                    <li><a href="<?= $router->generatePath('list-show', ['id' => $shoppingList->getId()]) ?>">Details</a></li>
                    <li><a href="<?= $router->generatePath('list-edit', ['id' => $shoppingList->getId()]) ?>">Edit</a></li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>

<?php $mainn = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
