<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $el_pastas
 * @property string $pavarde
 * @property string $vardas
 * @property int $role
 * @property \Carbon\Carbon $paskutinis_prisijungimas
 * @property string $miestas
 * @property string $adresas
 * @property string $slaptazodis
 * @property bool $ar_patvirtinta
 * 
 * @property \Illuminate\Database\Eloquent\Collection $aplankyta_vieta
 * @property \Illuminate\Database\Eloquent\Collection $komentaras
 * @property \Illuminate\Database\Eloquent\Collection $komentaro_vertinimas
 * @property \Illuminate\Database\Eloquent\Collection $sarasas
 * @property \Illuminate\Database\Eloquent\Collection $sertifikatas
 * @property \Illuminate\Database\Eloquent\Collection $vietos_vertinimas
 *
 * @package App\Models
 */
class User extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'role' => 'int',
		'ar_patvirtinta' => 'bool'
	];

	protected $dates = [
		'paskutinis_prisijungimas'
	];

	protected $fillable = [
		'el_pastas',
		'pavarde',
		'vardas',
		'role',
		'paskutinis_prisijungimas',
		'miestas',
		'adresas',
		'slaptazodis',
		'ar_patvirtinta'
	];

	public function aplankyta_vieta()
	{
		return $this->hasMany(\App\Models\AplankytaVietum::class, 'fk_VARTOTOJASid');
	}

	public function komentaras()
	{
		return $this->hasMany(\App\Models\Komentara::class, 'fk_VARTOTOJASid');
	}

    public function blokas()
    {
        return $this->hasMany(\App\Models\Blokuoti::class, 'fk_VARTOTOJASid');
    }

	public function komentaro_vertinimas()
	{
		return $this->hasMany(\App\Models\KomentaroVertinima::class, 'fk_VARTOTOJASid');
	}

	public function sarasas()
	{
		return $this->hasMany(\App\Models\Sarasa::class, 'fk_VARTOTOJASid');
	}

	public function sertifikatas()
	{
		return $this->hasMany(\App\Models\Sertifikata::class, 'fk_VARTOTOJASid');
	}

	public function vietos_vertinimas()
	{
		return $this->hasMany(\App\Models\VietosVertinima::class, 'fk_VARTOTOJASid');
	}
}
