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

    protected $fillable = ['kd_ruangan', 'nama_ruangan', 'keterangan', 'videos', 'kapasitas', 'jamPenyewaan'];

    /**
     * Get all of the images for the Ruangan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(UploadImage::class, 'ruangan_id', 'id');
    }
}
