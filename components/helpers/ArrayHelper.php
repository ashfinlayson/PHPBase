<?php

namespace ashfinlayson\base\components\helpers;

/**
 * Array helper methods for general use
 *
 * @author Ashley Finlayson
 */
class ArrayHelper
{
    /**
     * Sorts a multidimension array by a given key in a given order
     * @param array $array
     * @param string $key
     * @param PHP predefined constant $sortOrder
     * @return array||false
     */
    public static function sortMultiDimensionalArrayOnKey($array, $key, $sortOrder = SORT_ASC)
    {
        // Emtpy array to store values as given key
        $keys = [];
        // Loop through the main array
        foreach($array as $innerArray) {
            // push the value at the given key
            $keys[] = $innerArray[$key];
        }
        // Do a multisort to sort the multidimensional array by the key=>values
        $result = array_multisort($array, $keys, $sortOrder);
        // if sort was successful, return the array, else return false
        return ($result ? $array : false);
    }
    
    /**
     * Validates if var is array and not empty
     * @param Array $array
     * @return Boolean
     */
    public static function isArrayWithData($array)
    {
        return is_array($array) && !empty($array);
    }
    
}
