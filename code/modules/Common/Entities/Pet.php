<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class Pet extends BaseEntity
{
    use Notifiable;

    protected $table = 'm_pet';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'pet_type_id',
        'name',
        'gender',
        'birth_day',
        'dead_day',
        'age',
        'story',
        'diary',
        'guest_book',
        'status',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    public function PetType()
    {
        return $this->belongsTo(PetType::class, 'pet_type_id', 'id');
    }

    public function OwnerPet()
    {
        return $this->hasMany(OwnerPet::class, 'pet_id', 'id');
    }

    public function PetMedia()
    {
        return $this->hasMany(PetMedia::class, 'pet_id', 'id');
    }
}