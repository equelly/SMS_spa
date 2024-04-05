<?php

namespace App\Http\Controllers\User\Order;


use Illuminate\Routing\Controller as BaseController;
use App\Models\Set;



class SetController extends BaseController
{
    public function __invoke(){


        $sets = Set::all();
        
        return $sets;
            
    }
}
