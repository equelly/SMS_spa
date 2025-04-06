<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Requests\Order\FilterRequest;
use App\Models\Category;
use App\Models\Mashine;
use App\Models\MashineSet;
use App\Models\Order;
use App\Models\Set;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class FilterListController extends BaseController
{

        public function __invoke(Order $order){
            
           $categories = Category::all();
           $users = User::all();
           $mashines = Mashine::all();
          $fromDate = Order::orderBy('created_at', 'ASC')->first()->created_at;
          $toDate = Order::orderBy('created_at', 'DESC')->first()->created_at;

           $result = [
            'categories' => $categories,
            'users' => $users,
            'mashines' => $mashines,
            'dates' => [
              'from' => $fromDate,
                'to' => $toDate
            ],

        ];
            
          return response()->json($result);  
        }
        
       
    
    

}
