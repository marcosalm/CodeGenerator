<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 18/05/2016
 * Time: 18:32
 */

namespace AppTest\Business;


use Interop\Container\ContainerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Application;
/**
 * HomePage Integration Test
 */
class HomePageTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Application */
    protected $app;
    public function setup()
    {
        /** @var ContainerInterface $container */
        $container = require 'config/container.php';
        $this->app = $container->get('Zend\Expressive\Application');
    }
    public function testIntegrationExample()
    {
        $request  = new ServerRequest([], [], 'https://example.com/', 'GET');
        $response = $this->app->__invoke($request, new Response());
        $body     = (string) $response->getBody();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertContains('{"welcome":"Congratulations! You have installed the zend-expressive skeleton application.","docsUrl":"zend-expressive.readthedocs.org"}', $body);
    }
}