<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasRole extends Model
{
    public const TABLE_NAME = 'uas_user_has_roles';

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = UserHasRole::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
