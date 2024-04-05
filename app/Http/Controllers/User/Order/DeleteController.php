<?php

namespace App\Http\Controllers\User\Order;


use Illuminate\Routing\Controller as BaseController;
use App\Models\MashineSet;
use App\Models\Order;


class DeleteController extends BaseController
{
    public function __invoke(Order $order){

      
          $order->delete();
          //с помощью хелпера response() вернем пустой массив (перевый аргумент, вторым может быть статус запроса 404 например)
    
          return response([]);
    }
}
