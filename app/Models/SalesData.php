<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class SalesData extends Model
{
    protected $fillable = ['sub_category_id', 'date', 'value', 'additional_info'];

    protected $casts = [
        'date' => 'date',
        'additional_info' => 'array',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
