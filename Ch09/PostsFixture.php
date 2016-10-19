<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class PostsFixture extends TestFixture
{
    public $import = ['model' => 'Posts'];
    
    public $records = [
        [
            'id' => 1,
            'category_id' => 1,
            'user_id' => 1,
            'title' => 'First Post Tilte',
            'body' => 'This is the body of the first post...',
            'created' => '2016-05-01 13:00:00',
            'modified' => '2016-05-01 13:00:00'
        ],
    ];
}
