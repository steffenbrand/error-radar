<?php

namespace App\Model\Table;

use App\Model\Entity\Category;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\HasMany;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property PlansTable|HasMany $Plans
 *
 * @method Category get($primaryKey, $options = [])
 * @method Category newEntity($data = null, array $options = [])
 * @method Category[] newEntities(array $data, array $options = [])
 * @method Category|bool save(EntityInterface $entity, $options = [])
 * @method Category patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Category[] patchEntities($entities, array $data, array $options = [])
 * @method Category findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesTable extends Table
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

        $this->setTable('categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Plans', [
            'foreignKey' => 'category_id'
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }

    /**
     * Find all categories containing plans.
     *
     * @return ResultSetInterface
     * @throws \RuntimeException
     */
    public function findCategoriesContainingPlans(): ResultSetInterface
    {
        return $this
            ->find('all', ['contain' => ['Plans']])
            ->orderAsc('Categories.id')
            ->all();
    }

    /**
     * Find all categories containing plans.
     *
     * @return ResultSetInterface
     * @throws \RuntimeException
     */
    public function findCategoriesContainingPlansAndServers(): ResultSetInterface
    {
        return $this
            ->find('all', ['contain' => ['Plans' => 'Servers']])
            ->orderAsc('Categories.id')
            ->all();
    }
}
