<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
	protected $fillable = [
        'name', 'email', 'phone', 'amount', 'paid', 'description',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
