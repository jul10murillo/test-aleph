<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMDB extends Model
{
    use HasFactory;

    protected $table = 'cmdb';

    protected $fillable = ['category_id', 'identificador', 'nombre', 'extra_data'];

    protected $casts = [
        'extra_data' => 'array',
    ];
}