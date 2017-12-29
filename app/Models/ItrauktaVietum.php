<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ItrauktaVietum
 * 
 * @property string $aprasymas
 * @property string $fk_LANKYTINA_VIETAid
 * @property int $fk_SARASASid
 * 
 * @property \App\Models\LankytinaVietum $lankytina_vietum
 * @property \App\Models\Sarasa $sarasa
 *
 * @package App\Models
 */
class ItrauktaVietum extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'fk_SARASASid' => 'int'
	];

	protected $fillable = [
		'aprasymas'
	];

	public function lankytina_vietum()
	{
		return $this->belongsTo(\App\Models\LankytinaVietum::class, 'fk_LANKYTINA_VIETAid');
	}

	public function sarasa()
	{
		return $this->belongsTo(\App\Models\Sarasa::class, 'fk_SARASASid');
	}
}
