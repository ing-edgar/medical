<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'phone', 'rfc'];
    protected $searchableFields = ['*'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'appointments');
    }
}
