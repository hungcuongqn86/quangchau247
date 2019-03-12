<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class OwnerPet extends BaseEntity
{
    use Notifiable;

    protected $table = 's_owner_pet';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'owner_id',
        'pet_id'
    ];

    public function Pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'id');
    }

    public function Owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }
}