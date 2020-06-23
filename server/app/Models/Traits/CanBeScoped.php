<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Scoping\scoper;

trait CanBeScoped
{
    public function scopeWithScopes(Builder $builder, $scopes = [])
    {

    return (new scoper(request()))->apply($builder,$scopes) ;
    }
}

