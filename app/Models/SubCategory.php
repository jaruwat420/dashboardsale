<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\MainCategory;
use App\Models\SalesData;

class SubCategory extends Model
{
    protected $fillable = ['main_category_id', 'name', 'description'];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }

    public function salesData()
    {
        return $this->hasMany(SalesData::class);
    }
}
