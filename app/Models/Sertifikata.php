<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Sertifikata
 * 
 * @property int $id
 * @property string $pavadinimas
 * @property string $aprasymas
 * @property int $fk_VARTOTOJASid
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Sertifikata extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'fk_VARTOTOJASid' => 'int'
	];

	protected $fillable = [
		'pavadinimas',
		'aprasymas',
		'fk_VARTOTOJASid'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'fk_VARTOTOJASid');
	}
}
