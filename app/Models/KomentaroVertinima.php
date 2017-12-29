<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class KomentaroVertinima
 * 
 * @property int $vertinimas
 * @property int $fk_VARTOTOJASid
 * @property int $fk_KOMENTARASid
 * 
 * @property \App\Models\Komentara $komentara
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class KomentaroVertinima extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vertinimas' => 'int',
		'fk_VARTOTOJASid' => 'int',
		'fk_KOMENTARASid' => 'int'
	];

	protected $fillable = [
		'vertinimas'
	];

	public function komentara()
	{
		return $this->belongsTo(\App\Models\Komentara::class, 'fk_KOMENTARASid');
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'fk_VARTOTOJASid');
	}
}
