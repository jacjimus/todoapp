<?php

namespace App\Models;

use App\Models\Scopes\OwnerTasksScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(new OwnerTasksScope());
    }

    protected $fillable = ['title', 'description', 'user_id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
