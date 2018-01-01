<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AplankytaVietum
 * 
 * @property string $komentaras
 * @property int $fk_VARTOTOJASid
 * @property string $fk_LANKYTINA_VIETAid
 * 
 * @property \App\Models\User $user
 * @property \App\Models\LankytinaVietum $lankytina_vietum
 *
 * @package App\Models
 */
class AplankytaVietum extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'fk_VARTOTOJASid' => 'int'
	];

	protected $fillable = [
	    'date',
		'komentaras'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'fk_VARTOTOJASid');
	}

	public function lankytina_vietum()
	{
		return $this->belongsTo(\App\Models\LankytinaVietum::class, 'fk_LANKYTINA_VIETAid');
	}
}
