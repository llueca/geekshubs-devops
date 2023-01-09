<?php

namespace App\Models;

use App\Entities\TaskListEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'owner',
    ];

    protected $casts =[
        'created_at' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function toEntity(): TaskListEntity
    {
        return new TaskListEntity(
            $this->id,
            $this->name,
            $this->owner->id,
            [],
            $this->created_at
        );
    }
}
