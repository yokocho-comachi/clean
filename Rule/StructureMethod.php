<?php
// declare(strict_types=1);
namespace ValueValidator\Rule;

use ReflectionObject;

/**
 * rules validate method class
 * useable static
 *
 * @used-by \ValueValidator\Rule\Rules
 */
class StructureMethod
{

    /**
     * is allow check
     *
     * @param  array   $array    value
     * @param  array   $optional append value
     * @return bool
     */
    public function isAllowKeys(array $array, array $optional)
    {
        extract($optional);

        $before = count($array);
        $after  = count(array_intersect_key($array, array_flip($keys)));

        return $before === $after;
    }

    /**
     * is not null
     *
     * @param  array  $structure input value
     * @param  array  $optional  append value
     * @return bool
     */
    public function isNotNull($structure, array $optional)
    {
        extract($optional);

        return !is_null($structure[$key]);
    }

    /**
     * key more than target
     *
     * @param  array  $structure input value
     * @param  array  $optional  append value
     * @return bool
     */
    public static function moreThan(array $structure, array $optional): bool
    {
        extract($optional);
        if (!self::canCheck($structure[$key]) || !self::canCheck($structure[$target])) {
            return true;
        }

        return $structure[$key]->moreThan($structure[$target]);
    }

    /**
     * key less than target
     *
     * @param  array  $structure input value
     * @param  array  $optional  append value
     * @return bool
     */
    public static function lessThan(array $structure, array $optional): bool
    {
        extract($optional);
        if (!self::canCheck($structure[$key]) || !self::canCheck($structure[$target])) {
            return true;
        }

        return $structure[$key]->lessThan($structure[$target]);
    }

    /**
     * target or more
     *
     * @param  array  $structure input value
     * @param  array  $optional  append value
     * @return bool
     */
    public static function moreOr(array $structure, array $optional): bool
    {
        extract($optional);
        if (!self::canCheck($structure[$key]) || !self::canCheck($structure[$target])) {
            return true;
        }

        return $structure[$key]->moreOr($structure[$target]);
    }

    /**
     * target or less
     *
     * @param  array  $structure input value
     * @param  array  $optional  append value
     * @return bool
     */
    public static function lessOr(array $structure, array $optional): bool
    {
        extract($optional);
        if (!self::canCheck($structure[$key]) || !self::canCheck($structure[$target])) {
            return true;
        }

        return $structure[$key]->lessOr($structure[$target]);
    }

    /**
     * key same target
     *
     * @param  array  $structure input value
     * @param  array  $optional  append value
     * @return bool
     */
    public static function same(array $structure, array $optional): bool
    {
        extract($optional);
        if (!self::canCheck($structure[$key]) || !self::canCheck($structure[$target])) {
            return true;
        }

        return $structure[$key]->same($structure[$target]);
    }

    /**
     * key equals target
     *
     * @param  array  $structure input value
     * @param  array  $optional  append value
     * @return bool
     */
    public static function equals(array $structure, array $optional): bool
    {
        extract($optional);
        if (!self::canCheck($structure[$key]) || !self::canCheck($structure[$target])) {
            return true;
        }

        return $structure[$key]->equals($structure[$target]);
    }

    /**
     * can check value
     *
     * @param  mixed $valueObject object
     * @return bool
     */
    private static function canCheck($valueObject)
    {
        if (!is_a($valueObject, 'ValueValidator\Interfaces\Value\ValueObject')) {
            return false;
        }

        return !$valueObject->hasErrors();
    }
}
