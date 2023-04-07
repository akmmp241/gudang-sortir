<?php

namespace App\Services\Session;

use LaravelEasyRepository\Service;
use App\Repositories\Session\SessionRepository;

class SessionServiceImplement extends Service implements SessionService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(SessionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
