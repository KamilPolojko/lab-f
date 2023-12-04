<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;
switch ($action) {
    case 'list-index':
    case null:
        $controller = new \App\Controller\ShoppingListController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'list-create':
        $controller = new \App\Controller\ShoppingListController();
        $view = $controller->createAction($_REQUEST['shoppingList'] ?? null, $templating, $router);
        break;
    case 'list-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\ShoppingListController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['shoppingList'] ?? null, $templating, $router);
        break;
    case 'list-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\ShoppingListController();
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'list-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\ShoppingListController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;
    case 'info':
        $controller = new \App\Controller\InfoController();
        $view = $controller->infoAction();
        break;
    default:
        $view = 'Not found';
        break;
}

if ($view) {
    echo $view;
}
