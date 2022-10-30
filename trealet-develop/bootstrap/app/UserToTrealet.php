<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToTrealet extends Model
{
    use HasFactory;
	
	protected $table = 'user_to_trealet';
	protected $primaryKey = 'id';
	public $incrementing = true;
}
