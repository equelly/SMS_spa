<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Filters\OrderFilter;
use App\Http\Requests\Order\FilterRequest;
use App\Models\Category;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Mashine;
use App\Models\Order;
use App\Models\Trait\Filterable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SearchController extends BaseController
{
    use Filterable;

    public function __invoke(FilterRequest $request) {
        


        $data = $request->validated();
     // return $data;
         $filter = app()->make(OrderFilter::class, ['queryParams' => array_filter($data)]);//ошибка!!!
//return $filter;
         $orders = Order::filter($filter)->get();
         return $orders;
    
    }
}
