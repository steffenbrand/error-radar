<?php

namespace App\Model\Table;

use App\Model\Entity\Plan;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plans Model
 *
 * @property CategoriesTable|BelongsTo $Categories
 * @property ServersTable|BelongsTo $Servers
 *
 * @method Plan get($primaryKey, $options = [])
 * @method Plan newEntity($data = null, array $options = [])
 * @method Plan[] newEntities(array $data, array $options = [])
 * @method Plan|bool save(EntityInterface $entity, $options = [])
 * @method Plan patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Plan[] patchEntities($entities, array $data, array $options = [])
 * @method Plan findOrCreate($search, callable $callback = null, $options = [])
 */
class PlansTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('plans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Servers', [
            'foreignKey' => 'server_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('key')
            ->requirePresence('key', 'create')
            ->notEmpty('key')
            ->add('key', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->allowEmpty('name');

        $validator
            ->scalar('state')
            ->allowEmpty('state');

        $validator
            ->integer('number')
            ->allowEmpty('number');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['key']));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['server_id'], 'Servers'));

        return $rules;
    }

    /**
     * Find all plans containing categories and servers.
     *
     * @return ResultSetInterface
     * @throws \RuntimeException
     */
    public function findPlansContainingCategoriesAndServers(): ResultSetInterface
    {
        return $this
            ->find('all', ['contain' => ['Categories', 'Servers']])
            ->orderAsc('Plans.id')
            ->all();
    }
}
