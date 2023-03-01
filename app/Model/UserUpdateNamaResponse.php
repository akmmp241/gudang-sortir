<?php

namespace Akmalmp\GudangSortir\Model;

use Akmalmp\GudangSortir\Domain\User;

class UserUpdateNamaResponse
{
    private User $user;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}