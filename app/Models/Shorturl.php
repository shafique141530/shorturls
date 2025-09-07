<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shorturl extends Model
{
    use HasFactory;
	
	
	public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
	
	
	public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
