<?php

namespace App\Http\Filters;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends AbstractFilter
{
    //константам присваиваем ключи из массива request
    //значения попадут в запрос
    public const CONTENT = 'content';
    public const USER = 'user';
    public const MASHINE = 'mashine';
    public const CATEGORY = 'category';
    public const DATES = 'dates';
   

    protected function getCallbacks(): array
    {
        return [
          
            self::CONTENT => [$this, 'content'],
            self::USER => [$this, 'user'],
            self::MASHINE => [$this, 'mashine'],
            self::CATEGORY => [$this, 'category'],
            self::DATES => [$this, 'dates'],
          
        ];
    }
    public function user(Builder $builder, $value)
    {
        $builder->whereIn('user_id_req', $value);
    }
    public function content(Builder $builder, $value)
    {
        $builder->where('content', 'like', '%' . $value . '%');
    }
    public function dates(Builder $builder, $value)
    {
        $builder->whereBetween ('created_at', [$value[0], $value[1]]);
    }
    public function mashine(Builder $builder, $value)
    {
        $builder->whereIn ('mashine_id', $value);
    }
    public function category(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

}