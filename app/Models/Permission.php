<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-07
 * Time: 14:54
 */

namespace App\Models;


use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	protected $guarded = ['id'];
	protected $dateFormat = 'Y-m-d H:i:s';

	public function children()
	{
		return $this->hasMany(Permission::class, 'pid')->orderBy('sort');
	}

	public function father()
	{
		return $this->belongsTo(Permission::class, 'pid');
	}

	public static function boot()
	{
		static::created(function ($entity) {
			if (!empty($entity->father)) {
				$entity->flag = $entity->father->flag . '-' . $entity->id;
			} else {
				$entity->flag = $entity->id;
			}
			$entity->save();
		});

		static::updating(function ($entity) {
			$old = static::find($entity->id);
			if ($old->pid != $entity->pid) {
				$father = static::find($entity->pid);
				$entity->flag = $father->flag . '-' . $entity->id;
				event(new FlagChangedEvent($entity));
			}
		});

		static::deleted(function ($entity) {
			static::where('flag', 'like', $entity->flag . '%')->delete();
		});

	}
}