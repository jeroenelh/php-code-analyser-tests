<?php

namespace App\PropertyNotSetInConstructor;

use ReflectionProperty;

/**
 * In this class we test if the check for uninitialized properties are correct.
 * With a Reflection class (ReflectionProperty) we check if the property is indeed initialized or not.
 *
 * Expected behavior:
 * The property is always initialized and no error is generated
 *
 *
 * PSALM - Incorrect behavior
 * According to psalm, the variable 'uninitialized' isn't always been initialized
 * ERROR: PropertyNotSetInConstructor
 * @link https://psalm.dev/074
 *
 * PHPSTAN - Correct behavior
 * With the default settings this will not generate an error because this check isn't active
 * If you activate the check "checkUninitializedProperties" this will generate no error
 * @link https://phpstan.org/config-reference#checkuninitializedproperties
 */
class MainClass
{
    public int $initialized;

    public int $uninitialized;

    public function __construct()
    {
        $this->initialized = 1;

        if (!(new ReflectionProperty(self::class, 'uninitialized'))->isInitialized($this)) {
            $this->uninitialized = 3;
        }
    }
}
