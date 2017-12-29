<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class VietosVertinima
 * 
 * @property int $vertinimas
 * @property int $fk_VARTOTOJASid
 * @property string $fk_LANKYTINA_VIETAid
 * 
 * @property \App\Models\LankytinaVietum $lankytina_vietum
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class VietosVertinima extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vertinimas' => 'int',
		'fk_VARTOTOJASid' => 'int'
	];

	protected $fillable = [
		'vertinimas'
	];

	public function lankytina_vietum()
	{
		return $this->belongsTo(\App\Models\LankytinaVietum::class, 'fk_LANKYTINA_VIETAid');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'fk_VARTOTOJASid');
	}
}
