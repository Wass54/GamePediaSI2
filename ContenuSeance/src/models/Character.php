<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model{
    protected $table = 'character';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function game(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, Game2character::class);
    }
}