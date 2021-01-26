<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakitFaximile extends Model
{
    use HasFactory;

    protected $table = 'rumah_sakit_faximile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_fax', 'rumah_sakit_id'
    ];

    public function rumahSakit()
    {
        return $this->belongsTo("App\Models\RumahSakit", "rumah_sakit_id", "id");
    }
}
