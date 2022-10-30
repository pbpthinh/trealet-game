<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trealets extends Model
{
    use HasFactory;

    const STEPQUEST_TYPE = 'stepquest';

    protected $fillable = [
        'json', 'user_id', 'title', 'type', 'published', 'state'
    ];
    protected $table = 'trealets';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public const UPDATED_AT = null;
}
