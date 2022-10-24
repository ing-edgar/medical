<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Weekday extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'day_number'];

    protected $searchableFields = ['*'];
}
