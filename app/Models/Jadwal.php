<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $guarded = ['id'];

    protected $fillable = ['day', 'waktuMulai', 'waktuSelesai', 'status'];

    /**
     * Get all of the penjadwalruangan for the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjadwalruangan(): HasMany
    {
        return $this->hasMany(PenjadwalanRuangan::class, 'jadwal_id', 'id');
    }
}
