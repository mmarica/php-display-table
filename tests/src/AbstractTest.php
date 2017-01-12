<?php
namespace Tests;

use PHPUnit_Framework_TestCase;


abstract class AbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * Load a .txt resource file corresponding to the test class and method
     *
     * @param $test The test class and method
     * @return string
     */
    protected function _loadTxtResource($test)
    {
        list($class, $method) = explode('::', $test);

        // extract folder name
        $resourceRoot = dirname(dirname(__FILE__)) . '/resources/';
        $folder = $resourceRoot . implode(DIRECTORY_SEPARATOR, explode('\\', substr($class, strlen('Tests\\')))) . '/';

        // extract file base name
        $file = substr($method, strlen('test_')) . '.txt';

        // return the file contents
        $content = file_get_contents($folder . $file);
        return $content;
    }
}