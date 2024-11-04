<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $guarded = ['id'];

    protected $fillable = ['kd_ruangan', 'nama_ruangan', 'thumbnail'];

    /**
     * Get all of the penjadwalanruangan for the Ruangan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjadwalanruangan(): HasMany
    {
        return $this->hasMany(PenjadwalanRuangan::class, 'ruangan_id', 'id');
    }
}
