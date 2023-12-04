<?php

/** @var \App\Model\ShoppingList $shoppingList */
/** @var \App\Service\Router $router */

$titlee = "{$shoppingList->getTitle()} ({$shoppingList->getId()})";
$bodyClasss = 'show';

ob_start(); ?>
    <h1><?= $shoppingList->getTitle() ?></h1>

    <ul class="action-list">
        <li> <a href="<?= $router->generatePath('list-index') ?>">Back to list</a></li>
        <li><a href="<?= $router->generatePath('list-edit', ['id'=> $shoppingList->getId()]) ?>">Edit</a></li>
    </ul>
<?php $mainn = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
