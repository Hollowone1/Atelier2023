<?php

namespace nrv\event\api\app\actions;

use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

abstract class AbstractAction
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function exception(\Exception $e): array
    {
        return [
            'message' => $e->getCode() . $e->getMessage(),
            'exception' => [
                'type' => get_class($e),
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]
        ];
    }

    abstract public function __invoke(Request $request, Response $response, $args): Response;
}