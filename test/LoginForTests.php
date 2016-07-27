<?php
namespace AppTest;

use Zend\Diactoros\Uri;
use Interop\Container\ContainerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Application;
use PHPUnit_Framework_TestCase as TestCase;

class LoginForTests extends TestCase {

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
        $this->request = new ServerRequest([], [], 'https://example.com/', 'POST');
    }

    public function login(){

        $request  = $this->request
            ->withUri(new Uri($this->uri))
            ->withMethod('POST')
            ->withAddedHeader('Content-type', 'application/x-www-form-urlencoded')
            ->withParsedBody([
                'userName' => 'marcos@test',
                'password' => 'Dcide123@'
            ]);

        $response = $this->app->__invoke($request, new Response());
        $data     = json_decode((string) $response->getBody(), true);
        return $data['result']['TOKEN'];
    }
}