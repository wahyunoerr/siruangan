<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadImage extends Model
{
    use HasFactory;

    protected $table = 'tbl_upload_image';

    protected $guarded = ['id'];

    protected $fillable = ['ruangan_id', 'images'];

    /**
     * Get the ruangan that owns the UploadImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }
}
