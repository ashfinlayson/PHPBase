<?php

namespace ashfinlayson\base;

/**
 * Base component class
 *
 * @author Ashley Finlayson
 */
class Component
{
    /**
     * Returns the unqualified classname
     */
    public function getClassName()
    {
        $reflectionClass = new \ReflectionClass($this);
        return $reflectionClass->getShortName();
    }
    
    /**
     * Proxy method, logic has been moved to array helper.
     * @param Array $array
     * @return Boolean
     */
    public function isArrayWithData($array)
    {
        return \ashfinlayson\base\components\helpers\ArrayHelper::isArrayWithData($array);
    }
}
