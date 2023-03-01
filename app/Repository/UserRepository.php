<?php

namespace Akmalmp\GudangSortir\Repository;

use Akmalmp\GudangSortir\Domain\User;
use PDO;

class UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statment = $this->connection->prepare("INSERT INTO users (id_user, email, nama, password) VALUES (?, ?, ?, ?)");
        $statment->execute([
            null,
            $user->getEmail(),
            $user->getNama(),
            $user->getPassword()
        ]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET nama = ?, email = ?, password = ? WHERE id_user = ?");
        $statement->execute([
            $user->getNama(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getId()
        ]);
        return $user;
    }

    public function findById(int $id_user): ?User
    {
        $statment = $this->connection->prepare("SELECT id_user, email, nama, password FROM users WHERE id_user = ?");
        $statment->execute([$id_user]);
        try {
            if ($row = $statment->fetch()) {
                $user = new User();
                $user->setId($row['id_user']);
                $user->setEmail($row['email']);
                $user->setNama($row['nama']);
                $user->setPassword($row['password']);
                return $user;
            } else {
                return null;
            }
        } finally {
            $statment->closeCursor();
        }
    }

    public function findByEmail(string $email): ?User
    {
        $statment = $this->connection->prepare("SELECT id_user, email, nama, password FROM users WHERE email = ?");
        $statment->execute([$email]);
        try {
            if ($row = $statment->fetch()) {
                $user = new User();
                $user->setId($row['id_user']);
                $user->setEmail($row['email']);
                $user->setNama($row['nama']);
                $user->setPassword($row['password']);
                return $user;
            } else {
                return null;
            }
        } finally {
            $statment->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM users");
    }
}