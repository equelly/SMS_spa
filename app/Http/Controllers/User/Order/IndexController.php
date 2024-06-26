<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Requests\Order\FilterRequest;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Mashine;

use Carbon\Carbon;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request){

        $data = $request->validated();
        //dd($data);

        $mashines = Mashine::all();
        
        //нужно передать в коллекцию $mashines дату в формате Carbon
        foreach($mashines as $mashine){
            
            foreach($mashine->sets as $set){
                $set->set = $set->name;
            }
            foreach($mashine->orders as $data){
                $data->category = $data->category;
                $data->user = $data->user;
                $data->userExec = $data->userExec;
                $data->carbonCreated= Carbon::parse($data->created_at)->diffForHumans();
                $data->carbonUpdated= Carbon::parse($data->updated_at)->diffForHumans();
            }
                 
        }
      
        return $mashines;//->where('category_id', 1)
        
 


        
            
    }
}
