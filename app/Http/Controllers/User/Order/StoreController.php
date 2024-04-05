<?php

namespace App\Http\Controllers\User\Order;


use App\Http\Requests\Order\StoreRequest;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Mashine;
use App\Models\Set;
use App\Models\MashineSet;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request){
    
        $data = $request->validated();
        //return $data;
        if(!isset($data['sets']) and $data['content']== ''){
          
    $error = 'Заполните поле заявки или выберите необходимый пункт в комплектации';
    return $error;
        }elseif(isset($data['sets'])){
          $sets = $data['sets'];
        
        
            //a из массива $data удалим
              unset($data['sets']);
              
            
              foreach($sets as $set){
                foreach($set as $s){
                  MashineSet::firstOrCreate([
                    'mashine_id'=>$data['mashine_id'],
                    'set_id'=>$s
                    ]);
                }
               
              }
              
          }

       
        $order = Order::create($data);
      return $order;
    }
}
