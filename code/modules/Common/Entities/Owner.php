<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class Owner extends BaseEntity
{
    use Notifiable;

    protected $table = 'm_owner';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'gender',
        'phone_number',
        'facebook',
        'email',
        'status',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    public function OwnerPet()
    {
        return $this->hasMany(OwnerPet::class, 'owner_id', 'id');
    }
}