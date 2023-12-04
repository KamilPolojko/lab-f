<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\ShoppingList;
use App\Service\Router;
use App\Service\Templating;

class ShoppingListController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $shoppingLists = ShoppingList::findAll();
        $html = $templating->render('shoppingList/index.html.php', [
            'shoppingLists' => $shoppingLists,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestPost, Templating $templating, Router $router): ?string
    {
        if ($requestPost) {
            $shoppingList = ShoppingList::fromArray($requestPost);
            // @todo missing validation
            $shoppingList->save();

            $path = $router->generatePath('list-index');
            $router->redirect($path);
            return null;
        } else {
            $shoppingList = new ShoppingList();
        }

        $html = $templating->render('shoppingList/create.html.php', [
            'shoppingList' => $shoppingList,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $postId, ?array $requestPost, Templating $templating, Router $router): ?string
    {
        $shoppingList = ShoppingList::find($postId);
        if (! $shoppingList) {
            throw new NotFoundException("Missing post with id $postId");
        }

        if ($requestPost) {
            $shoppingList->fill($requestPost);
            // @todo missing validation
            $shoppingList->save();

            $path = $router->generatePath('list-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('shoppingList/edit.html.php', [
            'shoppingList' => $shoppingList,
            'router' => $router,
        ]);
        return $html;
    }

    public function showAction(int $postId, Templating $templating, Router $router): ?string
    {
        $shoppingList = ShoppingList::find($postId);
        if (! $shoppingList) {
            throw new NotFoundException("Missing post with id $postId");
        }

        $html = $templating->render('shoppingList/show.html.php', [
            'shoppingList' => $shoppingList,
            'router' => $router,
        ]);
        return $html;
    }

    public function deleteAction(int $postId, Router $router): ?string
    {
        $shoppingList = ShoppingList::find($postId);
        if (! $shoppingList) {
            throw new NotFoundException("Missing post with id $postId");
        }

        $shoppingList->delete();
        $path = $router->generatePath('list-index');
        $router->redirect($path);
        return null;
    }
}
