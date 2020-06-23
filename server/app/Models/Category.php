<?php

namespace App\Models;

use CreateCategoriesTable;
use App\Models\Traits\HasChildren;
use App\Models\Traits\IsOrderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'order',
        
    ]; 

    use HasChildren, IsOrderable;

   
    public function children()
    {

        return $this->hasMany(Category::class, 'parent_id' , 'id');

    }

    public function products()
    {

        return $this->belongsToMany(Product::class);
    }

}
