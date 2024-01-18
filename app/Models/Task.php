<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function getIsCompletedAttribute($value)
    {
        return $value == 1 ? "Yes" : "No";
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d-M-Y', strtotime($value));
    }
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
