<?php

namespace App\Model\Table;

use App\Model\Entity\Server;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\HasMany;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Security;
use Cake\Validation\Validator;

/**
 * Servers Model
 *
 * @property PlansTable|HasMany $Plans
 *
 * @method Server get($primaryKey, $options = [])
 * @method Server newEntity($data = null, array $options = [])
 * @method Server[] newEntities(array $data, array $options = [])
 * @method Server|bool save(EntityInterface $entity, $options = [])
 * @method Server patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Server[] patchEntities($entities, array $data, array $options = [])
 * @method Server findOrCreate($search, callable $callback = null, $options = [])
 */
class ServersTable extends Table
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

        $this->setTable('servers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Plans', [
            'foreignKey' => 'server_id'
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

        $validator
            ->scalar('url')
            ->requirePresence('url', 'create')
            ->notEmpty('url')
            ->url('url');

        $validator
            ->scalar('username')
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

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
    public function findServersContainingPlans(): ResultSetInterface
    {
        return $this
            ->find('all', ['contain' => ['Plans']])
            ->orderAsc('Servers.id')
            ->all();
    }

    /**
     * Before save hook.
     *
     * @param $event
     * @param Server $entity
     * @param $options
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function beforeSave($event, $entity, $options)
    {
        if (strlen($entity->password) > 0) {
            $entity->password =  Security::encrypt($entity->password, Configure::read('Security.key'));
        }
    }
}
