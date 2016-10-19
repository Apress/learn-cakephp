<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class UsersFixture extends TestFixture
{

   public $import = ['model' => 'Users'];
   
   public $records = [
        [
            'id' => 1,
            'username' => 'rrd',
            'password' => 'Gouranga',
            'role' => 'admin',
            'created' => '2016-05-01 12:00:00',
            'modified' => '2016-05-01 12:00:00'
        ],
    ];
}
