<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjadwalanRuangan extends Model
{
    use HasFactory;

    protected $table = 'penjadwalanruangan';

    protected $guarded = ['id'];

    protected $fillable = [
        'ruangan_id',
        'jadwal_id',
        'event_id',
        'fasilitas',
        'harga',
        'status',
        'publish'
    ];

    /**
     * Get the jadwal that owns the PenjadwalanRuangan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

    /**
     * Get the ruangan that owns the PenjadwalanRuangan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    /**
     * Get the event that owns the PenjadwalanRuangan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
