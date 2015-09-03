<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity {
	protected function _setPassword($value) {
		$hasher = new DefaultPasswordHasher ();
		return $hasher->hash ( $value );
	}
	
	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [ 
			'name' => true,
			'password' => true,
			'exp_num_calories' => true,
			'meals' => true 
	];
}
