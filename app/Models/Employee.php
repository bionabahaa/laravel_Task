<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
		'first_name',
		'last_name',
		'company_id',
		'email',
		'phone'
	];


    protected $appends = [
		'fullname',
	];


    public function company()
	{
		return $this->belongsTo(Company::class, 'company_id');
	}
}
