<?php

namespace App\Repository;

use App\Repository;

class NewsRepository extends Repository
{
    public function create(string $title, string $content): bool
    {
        $stmt = $this->getPdo()->prepare("INSERT INTO news (title, content) VALUES (?, ?)");

        return $stmt->execute([$title, $content]);
    }

    public function update(int $id, string $title, string $content): bool
    {
        $stmt = $this->getPdo()->prepare("UPDATE news SET title = (?), content = (?) where id = (?)");

        return $stmt->execute([$title, $content, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->getPdo()->prepare("DELETE FROM news WHERE id = (?)");

        return $stmt->execute([$id]);
    }

    public function findAll(): array
    {
        return $this->getPdo()->query("SELECT * FROM news")->fetchAll();
    }

}