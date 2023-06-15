<?php

namespace App\Models;

use App\Models\Scopes\OwnerTasksScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'description', 'user_id'];

    /**
     *  Set a global scope for Task
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OwnerTasksScope());
    }

    /**
     * Task relationship to a User Model
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
