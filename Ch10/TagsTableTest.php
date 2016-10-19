<?php
namespace {
    // This allow us to configure the behavior of the "global mock"
    $mockIsUploadedFile = false;
}

namespace App\Model\Table {
    function is_uploaded_file()
    {
        global $mockIsUploadedFile;
        if ($mockIsUploadedFile === true) {
            return true;
        } else {
            return call_user_func_array(
                '\is_uploaded_file',
                func_get_args()
            );
        }
    }
}

namespace App\Test\TestCase\Model\Table {

    use App\Model\Table\TagsTable;
    use Cake\ORM\TableRegistry;
    use Cake\TestSuite\TestCase;

    /**
     * App\Model\Table\TagsTable Test Case
     */
    class TagsTableTest extends TestCase
    {

        /**
         * Test subject
         *
         * @var \App\Model\Table\TagsTable
         */
        public $Tags;

        /**
         * Fixtures
         *
         * @var array
         */
        public $fixtures = [
            'app.tags',
        ];

        /**
         * setUp method
         *
         * @return void
         */
        public function setUp()
        {
            parent::setUp();
            $config = TableRegistry::exists('Tags') ? [] : ['className' => 'App\Model\Table\TagsTable'];
            $this->Tags = TableRegistry::get('Tags', $config);
        }

        /**
         * tearDown method
         *
         * @return void
         */
        public function tearDown()
        {
            unset($this->Tags);

            parent::tearDown();
        }

        public function testProcessFile()
        {
            global $mockIsUploadedFile;
            $mockIsUploadedFile = true;
            $actual = $this->Tags->processFile('noFile');
            $this->assertTrue($actual);
        }
    }
}