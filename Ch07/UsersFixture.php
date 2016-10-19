<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => [
            'type' => 'integer', 'length' => 10, 'unsigned' => true, 
            'null' => false, 'default' => null, 'comment' => '', 
            'autoIncrement' => true, 'precision' => null
            ],
        'username' => [
            'type' => 'string', 'length' => 50, 'null' => true, 
            'default' => null, 'comment' => '', 'precision' => null, 
            'fixed' => null
            ],
        'password' => [
            'type' => 'string', 'length' => 50, 'null' => true, 
            'default' => null, 'comment' => '', 'precision' => null, 
            'fixed' => null
            ],
        'role' => [
            'type' => 'string', 'length' => 20, 'null' => true, 
            'default' => null, 'comment' => '', 'precision' => null, 
            'fixed' => null
            ],
        'created' => [
            'type' => 'datetime', 'length' => null, 'null' => true, 
            'default' => null, 'comment' => '', 'precision' => null
            ],
        'modified' => [
            'type' => 'datetime', 'length' => null, 'null' => true, 
            'default' => null, 'comment' => '', 'precision' => null
            ],
        '_constraints' => [
            'primary' => [
                'type' => 'primary', 'columns' => ['id'], 'length' => []
                ],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public function init()
    {
        $this->$records = [
        [
            'id' => 1,
            'username' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'role' => 'Lorem ipsum dolor ',
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ],
    ];
    }
}
