<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CategoriesFixture extends TestFixture
{

    public $import = ['model' => 'Categories'];
    
    public $records = [
        [
            'id' => 1,
            'category' => 'Category 1'
        ],
        [
            'id' => 2,
            'category' => 'Category 2'
        ],
    ];
}
