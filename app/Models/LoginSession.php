<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LoginSession extends Model
{
    protected $table = "uas_login_sessions";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = false;

    public function getExpiredAtMillis()
    {
        if ($this->expired_at !== null) {
            return Carbon::createFromTimeString($this->expired_at)->valueOf();
        } else {
            return Carbon::now()->valueOf();
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'expired_at'
    ];
}
