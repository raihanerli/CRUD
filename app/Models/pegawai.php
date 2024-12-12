<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;
    public $table = "pegawai"; //ini ditulis karena saat melakukan php db:seed pegawaisnya gaada karna diganti nama jd pegawai
    protected $fillable = ['nama', 'email'];
}
