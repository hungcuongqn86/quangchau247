<?php

namespace Modules\Common\Entities;

use Illuminate\Notifications\Notifiable;

class Version extends BaseEntity
{
    use Notifiable;

    protected $table = 'vs_version';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'app_code',
        'version_code',
        'link_apk',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}