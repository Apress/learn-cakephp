<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CategoriesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CategoriesController Test Case
 */
class CategoriesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.categories',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/categories');
        $this->assertResponseNotContains('Category 2');

        $this->session(['isAdmin' => true]);
        $this->get('/categories');
        $this->assertResponseContains('Category 2');
    }

}
