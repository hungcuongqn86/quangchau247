<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class PetMedia extends BaseEntity
{
    use Notifiable;

    protected $table = 'm_pet_media';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'pet_id',
        'dir',
        'name',
        'url',
        'file_type',
        'size',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}