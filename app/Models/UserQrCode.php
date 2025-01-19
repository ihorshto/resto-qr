<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserQrCode extends Model
{

    protected $table = 'user_qr_codes';

    protected $fillable = [
        'user_id',
        'title',
        'qr_code_path',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
