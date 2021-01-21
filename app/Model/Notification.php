<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $tabel        = 'notifications';
    protected $primaryKey	=	'notification_id';

    protected $fillable		=	[
        'referee_id',
        'message',
        'read_at',
    ];

    public function referee()
    {
        return $this->belongsTo('App\Model\Referee','referee_id');
    }

}
