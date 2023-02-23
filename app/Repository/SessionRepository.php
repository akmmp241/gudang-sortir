<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Domain\Session;
use PDO;

class SessionRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Session $session): Session
    {
        $statement = $this->connection->prepare("INSERT INTO sessions (id, user_id, user_email) VALUES (?, ?, ?)");
        $statement->execute([
            $session->getId(),
            $session->getUserId(),
            $session->getUserEmail()
        ]);
        return $session;
    }

    public function findById(string $id): ?Session
    {
        $statement = $this->connection->prepare("SELECT id, user_id, user_email FROM sessions WHERE id = ?");
        $statement->execute([$id]);
        try {
            if ($row = $statement->fetch()) {
                $session = new Session();
                $session->setId($row['id']);
                $session->setUserId($row['user_id']);
                $session->setUserEmail($row['user_email']);
                return $session;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM sessions");
    }
}