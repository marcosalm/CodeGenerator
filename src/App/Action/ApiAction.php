<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 27/07/2016
 * Time: 10:13
 */

namespace App\Action;


use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ApiAction {
    private $container;
    private $em;

    public function __construct(ContainerInterface $container, EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        $domain = $request->getAttribute('domain');
        $resource = $request->getAttribute('resource');
        $resourceId = $request->getAttribute('resourceId');
        $action = $request->getAttribute('action');

         switch ($request->getMethod()) {

            case 'GET':
                if(empty($action)){
                    $action = 'Action';
                }
                break;

            case 'POST':
                if(empty($action)){
                    $action = 'Create';
                }
                break;

            case 'PUT':
            case 'PATCH':
                if (!$resourceId) {
                    return $this->throwJsonException('Missing resource id for PATCH/PUT request', 400);
                }
                break;

            case 'DELETE':
                if (!$resourceId) {
                    return $this->throwJsonException('Missing resource id for DELETE request', 400);
                }
                break;

            default:
                return $this->throwJsonException('Unsupported request method', 405);
        }


        $class = sprintf('%s\\%s\\Action\\%s',$domain, $resource, $resource.$action);
        if (!class_exists($class)) {
            return $this->throwJsonException(sprintf('Requested resource not found: %s', $class), 400);
        }
        try {
            $callable = new $class($this->em);
            return $callable($request, $response, $next);
        } catch (\Exception $e) {
            return $this->throwJsonException($e->getMessage(), $e->getCode());
        }
    }

    private function throwJsonException($message, $status)
    {
        // Ensure a valid HTTP status
        if (!is_numeric($status)
            || ($status < 400)
            || ($status > 599)
        ) {
            $status = 500;
        }
        $response = new JsonResponse([], $status);
        $errors = [
            'errors' => [
                'status' => $response->getReasonPhrase() ? $status : 400,
                'title' => $response->getReasonPhrase() ?: 'Bad Request',
                'detail' => $message,
                'links' => [
                    'related' => 'http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html'
                ]
            ]
        ];
        return new JsonResponse($errors, $response->getStatusCode());
    }

}