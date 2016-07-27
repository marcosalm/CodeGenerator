<?php

namespace AppTest\App;

use AppTest\LoginForTests;
use Interop\Container\ContainerInterface;
use Prophecy\Argument;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;
use Zend\Expressive\Router\Route;
use Zend\Expressive\Router\RouterInterface;
use Zend\Stratigility\Http\Request;
use PHPUnit_Framework_TestCase as TestCase;

class ApiActionTest extends TestCase{
    /** @var  Request */
    protected $request;
    /** @var  RouterInterface */
    protected $router;
    /** @var  Uri sample */
    private $uri = "http://fmb_proto/api/DCompanies";
    private $token;

    public function setup()
    {
        /** @var ContainerInterface $container */
        $container    = require 'config/container.php';
        $config       = $container->get('config');
        /** @var RouterInterface $router */
        $this->router = $container->get(RouterInterface::class);
        foreach ($config['routes'] as $route) {
            $this->router->addRoute(new Route(
                $route['path'],
                $route['middleware'],
                $route['allowed_methods'],
                $route['name']
            ));
        }
        $this->request = new ServerRequest([], [], 'http://example.com/', 'GET', 'php://memory');

        $this->token = LoginForTests::login();
    }
    public function testResourceRequest()
    {
        $request = $this->request
            ->withUri(new Uri($this->uri))
            ->withMethod('GET')
            ->withAddedHeader('Authorization', $this->token);
        /** @var \Zend\Expressive\Router\RouteResult $result */
        $result  = $this->router->match($request);
        $params  = $result->getMatchedParams();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('DCompanies', $params['resource']);
        $this->assertArrayNotHasKey('resourceId', $params);
        $this->assertArrayNotHasKey('relation', $params);
        $this->assertArrayNotHasKey('relationId', $params);
    }
    public function testResourceIdRequest()
    {
        $request = $this->request
            ->withUri(new Uri($this->uri."/3"))
            ->withMethod('GET')
            ->withAddedHeader('Authorization', $this->token);
        /** @var \Zend\Expressive\Router\RouteResult $result */
        $result  = $this->router->match($request);
        $params  = $result->getMatchedParams();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('DCompanies', $params['resource']);
        $this->assertEquals(3, $params['resourceId']);
        $this->assertArrayNotHasKey('relation', $params);
        $this->assertArrayNotHasKey('relationId', $params);
    }
    
    public function testInvalidIdRequest()
    {
        $request = $this->request
            ->withUri(new Uri($this->uri.'/one'))
            ->withMethod('GET')
            ->withAddedHeader('Authorization', $this->token);
        /** @var \Zend\Expressive\Router\RouteResult $result */
        $result  = $this->router->match($request);
        $this->assertTrue($result->isFailure());
    }
}