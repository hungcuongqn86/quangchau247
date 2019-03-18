<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class Cart extends BaseEntity
{
    use Notifiable;

    protected $table = 'cart';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'shop_id',
        'amount',
        'begin_amount',
        'color',
        'colortxt',
        'count',
        'domain',
        'image',
        'method',
        'name',
        'note',
        'price',
        'price_arr',
        'pro_link',
        'pro_properties',
        'rate',
        'site',
        'size',
        'sizetxt',
        'status',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}