<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 04 Dec 2017 16:11:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LankytiosVietosTipai
 * 
 * @property int $id_LANKYTIOS_VIETOS_TIPAI
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $lankytina_vieta
 *
 * @package App\Models
 */
class LankytiosVietosTipai extends Eloquent
{
	protected $table = 'lankytios_vietos_tipai';
	protected $primaryKey = 'id_LANKYTIOS_VIETOS_TIPAI';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function lankytina_vieta()
	{
		return $this->hasMany(\App\Models\LankytinaVietum::class, 'tipas');
	}
}
