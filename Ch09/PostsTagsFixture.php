<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class PostsTagsFixture extends TestFixture
{
    public $import = ['model' => 'PostsTags'];

    public $records = [
        [
            'post_id' => 1,
            'tag_id' => 1
        ],
        [
            'post_id' => 1,
            'tag_id' => 3
        ],
    ];
}
