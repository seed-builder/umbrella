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
	protected $guarded=['id'];
	protected $dateFormat='Y-m-d H:i:s';
}