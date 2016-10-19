<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ReflectionClass;

/**
 * App\Model\Table\PostsTable Test Case
 */
class PostsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostsTable
     */
    public $Posts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.posts',
        'app.categories',
        'app.users',
        'app.comments',
        'app.tags',
        'app.posts_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Posts') ? [] : ['className' => 'App\Model\Table\PostsTable'];
        $this->Posts = TableRegistry::get('Posts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Posts);

        parent::tearDown();
    }

    public function testGetPostsInCategory()
    {
        $class = new ReflectionClass($this->Posts);
        $method = $class->getMethod('getPostsInCategory');
        $method->setAccessible(true);
        $actual = $method->invoke($this->Posts, 1);
        //$actual = $this->Posts->getPostsInCategory(1);
        $expected = 1;
        $this->assertEquals($expected, $actual->toArray()[0]->id);
    }

}