<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class MainCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
