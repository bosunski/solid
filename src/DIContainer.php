<?php

namespace Solid;

use Exception;
use ReflectionClass;

class DIContainer
{
    protected $instances = [];

    public function get($id, $parameters = [])
    {
        if (!isset($this->instances[$id])) {
            $this->set($id);
        }

        try {
            return $this->resolve($this->instances[$id], $parameters);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function set($key, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $key;
        }

        $this->instances[$key] = $concrete;
    }

    public function has($key)
    {
        if (array_key_exists($this->instances, $key)) {
            return true;
        }

        return false;
    }

    /**
     * @param $concrete
     * @param array $defaultParameters
     * @return object
     * @throws \ReflectionException
     * @throws Exception
     */
    public function resolve($concrete, $defaultParameters = [])
    {
        $class = new ReflectionClass($concrete);

        if (!$class->isInstantiable()) {
            throw new Exception(sprintf("Class %s is not instantiable", $concrete));
        }

        $constructor = $class->getConstructor();

        if (is_null($constructor)) {
            return $class->newInstance();
        }

        $parameters = $constructor->getParameters();

        $dependencies = $this->resolveDependencies($parameters, $defaultParameters);

        $dependencies = array_merge($dependencies, $parameters);

        return $class->newInstanceArgs($dependencies);
    }

    /**
     * @param $parameters
     * @param array $defaultParameters
     * @return array
     * @throws \ReflectionException
     * @throws Exception
     */
    public function resolveDependencies($parameters, array $defaultParameters): array
    {
        $dependencies = [];
        /**
         * @var $parameter \ReflectionParameter
         */
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if ($dependency === null) {
                if (isset($defaultParameters[$parameter->getName()])) {
                    $dependencies[] = $defaultParameters[$parameter->getName()];
                } elseif($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolve dependency {$parameter->getName()}");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }

        return $dependencies;
    }
}
