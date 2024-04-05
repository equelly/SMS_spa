<?php

namespace App\Http\Controllers\User\Order;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Mashine;


class CreateController extends BaseController
{
    public function __invoke(){
        $mashines = Mashine::all();

      return $mashines;
        
    }
}
