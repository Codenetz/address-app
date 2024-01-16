<?php

namespace Framework\Resolver;

use Framework\Kernel\HttpKernel;
use Framework\Route;

/**
 *
 */
class ControllerResolver
{
    /**
     * @var Route|null
     */
    protected ?Route $matchedRoute = null;

    /**
     * @param array $routes
     * @param HttpKernel $kernel
     */
    public function __construct(protected array $routes, protected HttpKernel $kernel)
    {
        $this->match();
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @return Route|null
     */
    public function getMatchedRoute(): ?Route
    {
        return $this->matchedRoute;
    }

    /**
     * @param Route|null $matchedRoute
     * @return void
     */
    public function setMatchedRoute(?Route $matchedRoute): void
    {
        $this->matchedRoute = $matchedRoute;
    }

    /**
     * @return void
     */
    protected function match(): void
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {
            if (
                $route->getPath() === $this->kernel->getRequest()->getPath() &&
                $route->getMethod() === $this->kernel->getRequest()->getRequestHttpMethod()
            ) {
                $this->setMatchedRoute($route);
                break;
            }
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function resolveController()
    {
        if (!class_exists($this->matchedRoute->getController()))
            throw new \Exception("Controller not found:" . $this->matchedRoute->getController());

        $controller = new ($this->matchedRoute->getController());

        if (!method_exists($controller, $this->matchedRoute->getAction()))
            throw new \Exception("Action not found:" . $this->matchedRoute->getAction());

        $args = $this->matchedRoute->getArgs();
        array_unshift($args, $this->kernel);

        return call_user_func_array([$controller, $this->matchedRoute->getAction()], $args);
    }
}