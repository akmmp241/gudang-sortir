<?php

namespace Akmalmp\GudangSortir\Domain;

class Session
{
    private string $id;
    private int $user_id;
    private string $user_email;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getUserEmail(): string
    {
        return $this->user_email;
    }

    /**
     * @param string $user_email
     */
    public function setUserEmail(string $user_email): void
    {
        $this->user_email = $user_email;
    }


}