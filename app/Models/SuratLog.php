<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratLog extends Model
{
    protected $fillable = ['action', 'user_id', 'old_status', 'new_status', 'notes'];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}