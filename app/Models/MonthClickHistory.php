<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthClickHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_name', 'year', 'month'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
