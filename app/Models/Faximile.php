<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faximile extends Model
{
    use HasFactory;

    protected $table = 'faximile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_faximile', 'rumah_sakit_id'
    ];

    public function rumahSakit()
    {
        return $this->belongsTo("App\Models\RumahSakit", "rumah_sakit_id", "id");
    }
}
