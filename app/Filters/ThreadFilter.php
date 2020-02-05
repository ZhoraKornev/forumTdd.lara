<?php

namespace App\Filters;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ThreadFilter extends Filters
{

    protected $filters = ['by'];
    /**
     * @param $userName
     */
    public function by($userName)
    {
        $user = User::whereName($userName)->firstOrFail();
        $this->builder->where('user_id', $user->id);
    }
}
