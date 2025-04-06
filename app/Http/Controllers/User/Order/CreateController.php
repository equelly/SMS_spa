<?php

namespace App\Http\Controllers\User\Order;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Mashine;


class CreateController extends BaseController
{
    public function __invoke(){
        $mashines = Mashine::all();
        // в blade можно обращаться через связи в моделях, а при работе с vue необходимо добавить в массив с машинами их комплектацию
        foreach($mashines as $mashine){  
          foreach($mashine->sets as $set){
              $set->set = $set->name;
          }         
      }

      return $mashines;
        
    }
}
