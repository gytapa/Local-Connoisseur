<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LankytinaVietum
 * 
 * @property string $id
 * @property string $pavadinimas
 * @property string $miestas
 * @property string $adresas
 * @property int $tipas
 * 
 * @property \App\Models\LankytiosVietosTipai $lankytios_vietos_tipai
 * @property \Illuminate\Database\Eloquent\Collection $aplankyta_vieta
 * @property \Illuminate\Database\Eloquent\Collection $itraukta_vieta
 * @property \Illuminate\Database\Eloquent\Collection $komentaras
 * @property \Illuminate\Database\Eloquent\Collection $vietos_vertinimas
 *
 * @package App\Models
 */
class LankytinaVietum extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'tipas' => 'int'
	];

	protected $fillable = [
		'pavadinimas',
		'miestas',
		'adresas',
		'tipas',
        'nuotrauka'
	];

	public function lankytios_vietos_tipai()
	{
		return $this->belongsTo(\App\Models\LankytiosVietosTipai::class, 'tipas');
	}

	public function aplankyta_vieta()
	{
		return $this->hasMany(\App\Models\AplankytaVietum::class, 'fk_LANKYTINA_VIETAid');
	}

	public function itraukta_vieta()
	{
		return $this->hasMany(\App\Models\ItrauktaVietum::class, 'fk_LANKYTINA_VIETAid');
	}

	public function komentaras()
	{
		return $this->hasMany(\App\Models\Komentara::class, 'fk_LANKYTINA_VIETAid');
	}

	public function vietos_vertinimas()
	{
		return $this->hasMany(\App\Models\VietosVertinima::class, 'fk_LANKYTINA_VIETAid');
	}
}
