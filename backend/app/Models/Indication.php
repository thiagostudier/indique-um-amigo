<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indication extends Model
{
    use HasFactory;

    protected $table = 'indications';

    protected $fillable = [
        'name',
        'cpf',
        'phone',
        'email',
        'status_id',
    ];

    public function status(){
    	return $this->belongsTo('App\Models\Status');
    }

}
