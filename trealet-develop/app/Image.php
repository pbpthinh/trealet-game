<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;


    protected $connection = 'mysql_zenphoto';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = DB::raw('`.images`');
    }
}
