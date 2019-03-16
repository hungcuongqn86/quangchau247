<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class Cart extends BaseEntity
{
    use Notifiable;

    protected $table = 'm_shop';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'url',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}