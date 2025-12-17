<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pekerjaan extends Model
{
    use SoftDeletes;

    protected $table = 'pekerjaan';

    protected $dates = ['deleted_at'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
