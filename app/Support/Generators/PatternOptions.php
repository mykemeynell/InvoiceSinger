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
     * The date option value.
     *
     * @var string
     */
    protected $year;

    /**
     * The month option value.
     *
     * @var string
     */
    protected $month;

    /**
     * The increment option value.
     *
     * @var string
     */
    protected $increment;

    /**
     * PatternOptions constructor.
     */
    function __construct()
    {
        $this->setYearValue(date('Y'));
        $this->setMonthValue(date('m'));
        $this->setIncrementValue(1);

        $this->options = [
            self::YEAR => date('Y'),
            self::MONTH => date('m'),
            self::INCREMENT => str_pad($this->increment, 6, 0, STR_PAD_LEFT),
        ];
    }

    /**
     * Set the value of the increment option.
     *
     * @param $value
     */
    public function setIncrementValue($value): void
    {
        $this->increment = $value;
    }

    /**
     * Set the value of the month option.
     *
     * @param $value
     */
    public function setMonthValue($value): void
    {
        $this->month = $value;
    }

    /**
     * Set the value of the year option.
     *
     * @param $value
     */
    public function setYearValue($value): void
    {
        $this->year = $value;
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
