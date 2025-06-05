<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const TABLE_NAME = 'uas_roles';

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = Role::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role'
    ];

    /**
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
