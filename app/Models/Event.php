<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'name',
        'harga',
    ];

    /**
     * Get all of the penjadwalruangan for the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjadwalruangan(): HasMany
    {
        return $this->hasMany(PenjadwalanRuangan::class, 'event_id', 'id');
    }
}
