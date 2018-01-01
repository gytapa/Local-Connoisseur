<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Komentara
 * 
 * @property int $id
 * @property string $tekstas
 * @property \Carbon\Carbon $laikas
 * @property string $ip_adresas
 * @property int $fk_VARTOTOJASid
 * @property string $fk_LANKYTINA_VIETAid
 * 
 * @property \App\Models\LankytinaVietum $lankytina_vietum
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $komentaro_vertinimas
 *
 * @package App\Models
 */
class Komentara extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'fk_VARTOTOJASid' => 'int'
	];

	protected $dates = [
		'laikas'
	];

	protected $fillable = [
	    'tema',
		'tekstas',
		'laikas',
		'ip_adresas',
		'fk_VARTOTOJASid',
		'fk_LANKYTINA_VIETAid'
	];

	public function lankytina_vietum()
	{
		return $this->belongsTo(\App\Models\LankytinaVietum::class, 'fk_LANKYTINA_VIETAid');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'fk_VARTOTOJASid');
	}

	public function komentaro_vertinimas()
	{
		return $this->hasMany(\App\Models\KomentaroVertinima::class, 'fk_KOMENTARASid');
	}
}
