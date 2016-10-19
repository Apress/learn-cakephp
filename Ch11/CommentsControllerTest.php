<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CommentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CommentsController Test Case
 */
class CommentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.comments',
        'app.categories',
        'app.posts',
        'app.users'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/comments');
        $this->assertResponseOk();
    }

    public function testViewUnauthenticated()
    {
        $this->get('/comments/view/1');
        $this->assertRedirect(
            [
                'controller' => 'Users',
                'action' => 'login'
            ]
        );
    }

    public function testViewAuthenticated()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'rrd',
                    'role' => 10
                ]
            ]
        ]);
        $this->get('/comments/view/1');
        $this->assertResponseOk();
    }
    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->configRequest(
            [
                'headers' => ['Accept' => 'application/json']
            ]
        );
        $data = [
            'comment' => 'Call out Gouranga and be happy',
            'user_id' => 1,
            'post_id' => 1,
            'category_id' => 2
        ];
        $this->post('/comments/add.json', $data);
        $this->assertResponseSuccess();

        $expected = [
            'comment' => [
                'comment' => 'Call out Gouranga and be happy',
                'user_id' => 1,
                'post_id' => 1,
                'category_id' => 2,
                'id' => 2
            ],
        ];
        $expected = json_encode($expected, JSON_PRETTY_PRINT);
        $this->assertEquals($expected, $this->_response->body());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
