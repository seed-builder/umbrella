<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2017-06-07
 * Time: 14:53
 */

namespace App\Models;


use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $guarded=['id'];
	protected $dateFormat='Y-m-d H:i:s';
}