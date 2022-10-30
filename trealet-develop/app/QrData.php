<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrData extends Model
{
    use HasFactory;
    protected $table = 'qrdatas';
    protected $fillable=[
        'id',
        'qr_code',
        'url_data' 
    ];
}
