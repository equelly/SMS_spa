<?php

namespace App\Http\Controllers\User\Order;


use Illuminate\Routing\Controller as BaseController;



use Illuminate\Support\Facades\Auth;

class UserNameController extends BaseController
{
    public function __invoke(){

        $user = Auth::user();

        return $user;
            
    }
}
