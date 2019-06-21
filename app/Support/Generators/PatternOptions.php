<?php

namespace InvoiceSinger\Support\Generators;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * Class PatternOptions
 *
 * @package InvoiceSinger\Support\Generators
 */
class PatternOptions implements ArrayAccess, IteratorAggregate
{
    const YEAR = "%year%";
    const MONTH = "%month%";
    const INCREMENT = "%increment%";

    /**
     * Options that can be used in keys.
     *
     * @var array
     */
    protected $options = [];

    /**
     * PatternOptions constructor.
     */
    function __construct()
    {
        $this->options = [
            self::YEAR => date('Y'),
            self::MONTH => date('m'),
            // TODO: Add option to specify specific option value - invoice.key wouldn't be used for quotes
            self::INCREMENT => str_pad($this->options[self::INCREMENT], 6, 0, STR_PAD_LEFT),
        ];
    }

    /**
     * Set the value of the increment option.
     *
     * @param $value
     */
    public function setIncrementValue($value): void
    {
        $this->options[self::INCREMENT] = $value;
    }

    /**
     * Transform this object to a string.
     *
     * @return string
     */
    function __toString(): string
    {
        return json_encode($this->options);
    }

    /**
     * Whether a offset exists
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return property_exists($this->options, $offset);
    }

    /**
     * Offset to retrieve
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->options[$offset];
    }

    /**
     * Offset to set
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->options[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->options[$offset]);
    }

    /**
     * Retrieve an external iterator
     *
     * @link  https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new ArrayIterator($this->options);
    }
}
