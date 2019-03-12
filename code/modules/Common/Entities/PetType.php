<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class PetType extends BaseEntity
{
    use Notifiable;

    protected $table = 'm_pet_type';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    public function Pet()
    {
        return $this->hasMany(Pet::class, 'pet_type_id', 'id');
    }
}