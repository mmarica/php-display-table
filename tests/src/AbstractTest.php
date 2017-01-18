<?php
namespace Tests;

use PHPUnit_Framework_TestCase;


abstract class AbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * Load a .txt resource file corresponding to the test class and method
     *
     * @param string $test      The test class and method names
     * @param string $extension (optional) The file extension
     * @return string
     */
    protected function _loadResource($test, $extension = '.txt')
    {
        $content = file_get_contents($this->_getResourceFilename($test, $extension));
        return $content;
    }

    /**
     * Get a resource file path and name corresponding to the test class and method
     *
     * @param string $test      The test class and method names
     * @param string $extension (optional) The file extension
     * @return string
     */
    protected function _getResourceFilename($test, $extension = '.txt')
    {
        list($class, $method) = explode('::', $test);
        // compute folder name
        $resourceRoot = dirname(dirname(__FILE__)) . '/resources/';
        $folder = $resourceRoot . implode(DIRECTORY_SEPARATOR, explode('\\', substr($class, strlen('Tests\\')))) . '/';

        // compute file base name
        $file = substr($method, strlen('test_')) . $extension;

        // file path and name
        return $folder . $file;
    }
}