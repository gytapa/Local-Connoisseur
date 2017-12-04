<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Sarasa
 * 
 * @property int $id
 * @property string $pavadinimas
 * @property string $aprasymas
 * @property \Carbon\Carbon $sukurimo_data
 * @property int $fk_VARTOTOJASid
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $itraukta_vieta
 *
 * @package App\Models
 */
class Sarasa extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'fk_VARTOTOJASid' => 'int'
	];

	protected $dates = [
		'sukurimo_data'
	];

	protected $fillable = [
		'pavadinimas',
		'aprasymas',
		'sukurimo_data',
		'fk_VARTOTOJASid'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'fk_VARTOTOJASid');
	}

	public function itraukta_vieta()
	{
		return $this->hasMany(\App\Models\ItrauktaVietum::class, 'fk_SARASASid');
	}
}
