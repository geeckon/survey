<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Question
 *
 * @mixin Builder
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'question_type_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function questionType()
    {
        return $this->belongsTo(QuestionType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function responses()
    {
        return $this->hasManyThrough(Response::class, Answer::class);
    }
}
