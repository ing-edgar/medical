<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['values', 'user_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'values' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
