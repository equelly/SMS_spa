<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Requests\Order\FilterRequest;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Mashine;
use App\Models\Order;
use Carbon\Carbon;

class PersonalController extends BaseController
{
    public function __invoke(FilterRequest $request){

        $data = $request->validated();
        
        
       $myorders = Order::all()->where('user_id_req', '=', auth()->user()->id);
       foreach($myorders as $myorder){
        $myorder->mashine = $myorder->mashine;
        $myorder->category = $myorder->category;
        $myorder->user = $myorder->user;
        $myorder->userExec = $myorder->userExec;
        $myorder->carbonCreated= Carbon::parse($myorder->created_at)->diffForHumans();
        $myorder->carbonUpdated= Carbon::parse($myorder->updated_at)->diffForHumans();
       }
       
        return $myorders;
            
    }
}
