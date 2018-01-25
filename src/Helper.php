<?php

namespace FbMessengerBot;

/**
 * Class Helper
 * 
 */
class Helper
{
    /**
     * Object to array
     *
     * @param object $object Object
     * @param array $array Array
     *
     * @return array
     */
    public function objectToArray($object, $array = [])
    {
        $reflectionClass = new \ReflectionClass(get_class($object));

        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);

            $name = trim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $property->getName())), '_');

            if (empty($property->getValue($object))) {
                continue;
            } else if (is_object($property->getValue($object))) {
                $array[$name] = $this->objectToArray($property->getValue($object));
            } else if (is_array($property->getValue($object))) {
                foreach ($property->getValue($object) as $key => $value) {
                    if (is_object($value)) {
                        $array[$name][] = $this->objectToArray($value);
                    }
                }
            } else {
                $array[$name] = $property->getValue($object);
            }

            $property->setAccessible(false);
        }

        return $array;
    }
}
