<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 24/05/2016
 * Time: 09:28
 */

namespace AppTest\App;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Diactoros\Uri;
use Interop\Container\ContainerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Application;

class LoginTest extends TestCase{

    /** @var  Application */
    protected $app;
    /** @var  ServerRequest */
    protected $request;
    /** @var  InMemoryUserRepository */
    protected $repository;

    private $uri = "http://fmb_proto/api/Login";

    public function setup() {
        /** @var ContainerInterface $container */
        $container = require 'config/container.php';
        $this->app = $container->get('Zend\Expressive\Application');
        $this->request = new ServerRequest();
    }

    public function testLogin(){

        $request  = $this->request
            ->withUri(new Uri($this->uri))
            ->withMethod('POST')
            ->withAddedHeader('Content-type', 'application/form-data')
            ->withParsedBody([
                'userName' => 'marcos@test',
                'password' => 'Dcide123@'
            ]);

        $response = $this->app->__invoke($request, new Response());



        $data     = json_decode((string) $response->getBody(), true);

        $this->assertEquals(500, $response->getStatusCode());
      //  $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
    }

    public function testWrongLogin(){

        $request  = $this->request
            ->withUri(new Uri($this->uri))
            ->withMethod('POST')
            ->withAddedHeader('Content-type', 'application/x-www-form-urlencoded')
            ->withParsedBody([
                'userName' => 'marcos@test',
                'password' => 'Dcide'
            ]);

        $response = $this->app->__invoke($request, new Response());
        $data     = json_decode((string) $response->getBody(), true);

        $this->assertEquals(500, $response->getStatusCode());
      //  $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
       // $this->assertArrayHasKey('errors', $data);
    }
    
}