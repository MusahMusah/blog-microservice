<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'title',
        'user_id',
        'description',
        'publication_date'
    ];
}
