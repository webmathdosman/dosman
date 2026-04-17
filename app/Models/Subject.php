<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
