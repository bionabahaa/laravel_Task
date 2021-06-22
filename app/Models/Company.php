<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'first_name',
        'email',
        'logo',
        'website',
    ];




    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
