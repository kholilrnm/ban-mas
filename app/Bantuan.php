<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $table = 'bantuan';
    protected $primaryKey = 'id_bantuan';
    protected $guarded = ['id_bantuan'];    
}
