<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PostsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

class PostsControllerTest extends IntegrationTestCase
{

    public $fixtures = [
        'app.posts',
        'app.categories',
        'app.users',
        'app.tags',
        'app.posts_tags'
    ];

    public function testIndex()
    {
        $this->get('/posts');
        $this->assertResponseOk();
    }
    
    public function testAdd()
    {
        $data = [
            'category_id' => 2,
            'user_id' => 1,
            'title' => 'Test Post Title',
            'body' => 'Test post body with same sample text',
            'created' => '2016-05-01 14:00:00',
            'modified' => '2016-05-01 14:00:00',
            'tags' => [
                ['id' => 1],
                ['id' => 2],
            ]
        ];
        $this->post('/posts/add/', $data);

        $this->assertResponseSuccess();
        
        $posts = TableRegistry::get('Posts');
        $query = $posts->find()->where(['title' => $data['title']]);
        $this->assertEquals(1, $query->count());
        
        $result = $query->toArray();
        $poststags = TableRegistry::get('PostsTags');
        $query = $poststags->find()->where(['post_id' => $result[0]->id]);
        $result = $query->toArray();
        $this->assertEquals(1, $result[0]->tag_id);
        $this->assertEquals(2, $result[1]->tag_id);
    }
    
    public function testEdit()
    {
        $this->get('/posts/edit/1');
        $this->assertResponseOk();
    }
}
