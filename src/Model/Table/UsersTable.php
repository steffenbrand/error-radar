<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method User get($primaryKey, $options = [])
 * @method User newEntity($data = null, array $options = [])
 * @method User[] newEntities(array $data, array $options = [])
 * @method User|bool save(EntityInterface $entity, $options = [])
 * @method User patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method User[] patchEntities($entities, array $data, array $options = [])
 * @method User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     * @throws \RuntimeException
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->add('password', [
                'validFormat' => [
                    'rule' => [
                        'custom',
                        '/(?=^.{8,30}$)(?=.*[!@#\/\\$%^&*,;:]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/'
                    ],
                    'message' => 'The password must be between 8 and 30 characters long and have at lest one uppercase character, one lowercase character, one digit and finally one special character.'
                ]
            ]);

        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role')
            ->add('role', 'inList', ['rule' => ['inList', ['admin', 'user']]]);

        return $validator;
    }

    /**
     * @param Validator $validator
     * @return Validator
     */
    public function validationPassword(Validator $validator): Validator
    {
        $validator
            ->add('password', [
                'validFormat' => [
                    'rule' => [
                        'custom',
                        '/(?=^.{8,30}$)(?=.*[!@#\/\\$%^&*,;:]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/'
                    ],
                    'message' => 'The password must be between 8 and 30 characters long and have at lest one uppercase character, one lowercase character, one digit and finally one special character.'
                ]
            ])
            ->notEmpty('password');

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
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }
}
