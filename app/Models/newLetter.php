<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newLetter extends Model
{
    use HasFactory;

    protected $table = 'new_letters';

    protected $fillable = ['emailContato'];
}
