<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model{
    protected $table = 'theme';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}