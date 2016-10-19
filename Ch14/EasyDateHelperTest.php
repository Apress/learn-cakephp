<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\EasyDateHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class EasyDateHelperTest extends TestCase
{

    public $helper = null;

    public function setUp()
    {
        parent::setUp();
        $View = new View();
        $this->helper = new EasyDateHelper($View);
    }

    public function testAdd()
    {
        $this->assertEquals('D: 2000-01-15', $this->helper->add(15));
        $this->assertEquals('D: 2000-04-09', $this->helper->add(100));
        $this->assertEquals('D: 2002-09-26', $this->helper->add(1000));
    }
}