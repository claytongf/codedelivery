<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\UserRepository;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authUser()
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->userRepository->find($id);
    }

}
