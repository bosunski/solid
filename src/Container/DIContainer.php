<?php

namespace Solid\Container;


use Exception;
use Psr\Container\ContainerInterface;
use ReflectionClass;

class DIContainer implements ContainerInterface
{
    protected $instances = [];

    public function has($key)
    {
        return isset($this->instances[$key]);
    }

    public function get($key, $parameters = [])
    {
        if (!$this->has($key)) {
            $this->set($key);
        }

        try {
            return $this->resolve($this->instances[$key], $parameters);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function set($key, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $key;
        }

        $this->instances[$key] = $concrete;
    }

    protected function resolve($concrete, $defaultParameters = [])
    {
        $class = new ReflectionClass($concrete);

        if (!$class->isInstantiable()) {
            throw new Exception(sprintf("Class %s is not instantiable", $class->getName()));
        }

        $constructor = $class->getConstructor();

        if (is_null($constructor)) {
            return $class->newInstance();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters, $defaultParameters);

        return $class->newInstanceArgs($dependencies);
    }

    /**
     * @param array $parameters
     * @param $defaultParameters
     * @return array
     * @throws \ReflectionException
     */
    protected function resolveDependencies($parameters = [], $defaultParameters = [])
    {
        $dependencies = [];

        /**
         * @var $parameter \ReflectionParameter
         */
        foreach ($parameters as $parameter) {
            $class = $parameter->getClass();

            if ($class === null) {
                if (isset($defaultParameters[$parameter->getName()])) {
                    $dependencies[] = $defaultParameters[$parameter->getName()];
                } elseif ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolve dependency: {$parameter->getName()}");
                }
            } else {
                $dependencies[] = $this->get($class->name);
            }
        }

        return $dependencies;
    }

    public function getInstances()
    {
        return $this->instances;
    }
}
