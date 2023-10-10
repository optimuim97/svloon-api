<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSaved extends Model
{
    use HasFactory;

    protected $table = "data_saved";
    protected $fillable  = ["received_data"];
}
