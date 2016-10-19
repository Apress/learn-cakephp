<?php
use Cake\TestSuite\TestSuite;

class AllModelTableTest extends TestSuite
{
    public static function suite() {
        $suite = new TestSuite('All model table tests');
        $suite->addTestDirectory(TESTS . 'TestCase/Model/Table');
        return $suite;
    }
}
