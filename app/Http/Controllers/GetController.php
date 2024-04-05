<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\FilterRequest;
use App\Models\Mashine;
use App\Models\MashineSet;
use App\Models\Order;
use App\Models\Set;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class GetController extends Controller
{

        public function __invoke(){
            
            $orders = Order::all()->where('category_id', '=','1')->where('content', '!=', '');
           
            return $orders;
            
            
        }
        
       
    
    

}
