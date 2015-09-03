<?php
namespace App\Model\Table;

use App\Model\Entity\Meal;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Meals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class MealsTable extends Table
{
	
	public function findRange(Query $query, array $options) {
		$fromDate = $options ['fromDate'];
		$toDate = $options ['toDate'];
		$fromTime = $options ['fromTime'];
		$toTime = $options ['toTime'];

		$conditions = array('Meals.user_id' => $options ['user_id']);

		if ($fromDate != null || $toDate != null) {
			if ($fromDate == null) {
				$fromDate = time();
			}
			if ($toDate == null) {
				$toDate = time();
			}
				
// 			if (intval($fromDate) > intval($toDate)) {
// 				list($toDate, $fromDate) = array($fromDate, $toDate);
// 			}

			$conditions['Meals.date >='] = strftime ( '%Y-%m-%d', intval($fromDate) );
			$conditions['Meals.date <='] = strftime ( '%Y-%m-%d', intval($toDate) );
// 			$conditions['Meals.date >='] = intval($fromDate);
// 			$conditions['Meals.date <='] = intval($toDate);
		}
		
		if ($fromTime != null || $toTime != null) {
			if ($fromTime == null) {
				$fromTime = time();
			}
			if ($toTime == null) {
				$toTime = time();
			}
			
// 			if ($fromTime +0 > $toTime +0) {
// 				list($toTime, $fromTime) = array($fromTime, $toTime);
// 			}
			
			$conditions['Meals.time >='] = strftime ( '%H:%M:%S', intval($fromTime) );
			$conditions['Meals.time <='] = strftime ( '%H:%M:%S', intval($toTime) );
// 			$conditions['Meals.time >='] = intval($fromTime);
// 			$conditions['Meals.time <='] = intval($toTime);
		}

		$query->where ($conditions);
		return $query;
	}

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('meals');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');
            
        $validator
            ->add('date', 'valid', ['rule' => 'date'])
            ->requirePresence('date', 'create')
            ->notEmpty('date');
            
        $validator
            ->add('time', 'valid', ['rule' => 'time'])
            ->requirePresence('time', 'create')
            ->notEmpty('time');
            
        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');
            
        $validator
            ->add('calories', 'valid', ['rule' => 'numeric'])
            ->requirePresence('calories', 'create')
            ->notEmpty('calories');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
