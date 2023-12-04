<?php
namespace App\Model;

use App\Service\Config;

class ShoppingList
{
    private ?int $id = null;
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): ShoppingList
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): ShoppingList
    {
        $this->title = $title;

        return $this;
    }

    public static function fromArray($array): ShoppingList
    {
        $shoppingList = new self();
        $shoppingList->fill($array);

        return $shoppingList;
    }

    public function fill($array): ShoppingList
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }


        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM shoppingList';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $shoppingLists = [];
        $shoppingListsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($shoppingListsArray as $shoppingListArray) {
            $shoppingLists[] = self::fromArray($shoppingListArray);
        }

        return $shoppingLists;
    }

    public static function find($id): ?ShoppingList
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM shoppingList WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $shoppingListArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $shoppingListArray) {
            return null;
        }
        $shoppingList = ShoppingList::fromArray($shoppingListArray);

        return $shoppingList;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO shoppingList (title) VALUES (:title)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'title' => $this->getTitle(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE shoppingList SET title = :title WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':title' => $this->getTitle(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM shoppingList WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setTitle(null);

    }
}
