<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Resources\OrderResource;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Mashine;
use App\Models\Order;

class ShowController extends BaseController
{
    public function __invoke($id){
        $order = Order::query()->find($id);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order does not exist']);
        }
        return response()->json(['success' => true, 'order' => new OrderResource($order)]);
    
    }
}
