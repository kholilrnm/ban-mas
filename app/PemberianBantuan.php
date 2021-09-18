<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemberianBantuan extends Model
{
    protected $table = 'pemberian_bantuan';
    protected $primaryKey = 'id_pemberian_bantuan';
    protected $guarded = ['id_pemberian_bantuan'];    
}
