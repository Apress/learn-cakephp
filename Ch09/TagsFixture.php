<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class TagsFixture extends TestFixture
{
    public $import = ['model' => 'Tags'];
    
    public $records = [
        [
            'id' => 1,
            'tag' => 'Tag 1'
        ],
        [
            'id' => 2,
            'tag' => 'Tag 2'
        ],
        [
            'id' => 3,
            'tag' => 'Tag 3'
        ],
    ];
}
