<?php


namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Blokuoti
 *
 * @property int $id
 * @property string $priezastis
 * @property \Carbon\Carbon $laikas
 * @property int $fk_VARTOTOJASid
 *
 * @property \App\Models\Blokuoti $blokuoti
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Blokuoti extends Eloquent
{

    protected $casts = [
        'fk_VARTOTOJASid' => 'int'
    ];

    protected $dates = [
        'laikas'
    ];

    protected $fillable = [
        'priezastis',
        'laikas',
        'fk_VARTOTOJASid'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'fk_VARTOTOJASid');
    }

}
