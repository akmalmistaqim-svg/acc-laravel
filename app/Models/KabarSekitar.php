<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KabarSekitar extends Model
{
    protected $table = 'kabar_sekitar';

    protected $fillable = [
        'user_id',
        'kota',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(AccUser::class, 'user_id');
    }

    public function getRatingStarsAttribute()
    {
        return str_repeat('⭐', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->translatedFormat('d F Y, H:i');
    }
}