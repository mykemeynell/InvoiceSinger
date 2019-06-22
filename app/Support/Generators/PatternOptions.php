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
    const YEAR_4 = "%Y%";
    const YEAR_2 = "%y%";
    const MONTH_2 = "%m%";
    const MONTH_1 = "%n%";
    const MONTH_FULL = "%F%";
    const WEEK = "%W%";
    const INCREMENT = "%increment%";

    /**
     * Options that can be used in keys.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The four digit year option value.
     *
     * @var string
     */
    protected $year_4;

    /**
     * The two digit year option value.
     *
     * @var string
     */
    protected $year_2;

    /**
     * The single digit month value.
     *
     * @var string
     */
    protected $month_1;

    /**
     * The two digit month value.
     *
     * @var string
     */
    protected $month_2;

    /**
     * The full month option value.
     *
     * @var string
     */
    protected $month_full;

    /**
     * The week option value.
     *
     * @var string
     */
    protected $week;

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
        $this->setYear4(date('Y'));
        $this->setYear2(date('y'));
        $this->setMonthFull(date('F'));
        $this->setMonth2(date('m'));
        $this->setMonth1(date('n'));
        $this->setWeek(date('W'));

        $this->buildOptions();
    }

    /**
     * Build the options array.
     *
     * @return void
     */
    protected function buildOptions(): void
    {
        $this->options = [
            self::YEAR_4 => $this->year_4,
            self::YEAR_2 => $this->year_2,
            self::MONTH_1 => $this->month_1,
            self::MONTH_2 => $this->month_2,
            self::MONTH_FULL => $this->month_full,
            self::WEEK => $this->week,
            self::INCREMENT => str_pad($this->increment, 6, 0, STR_PAD_LEFT),
        ];
    }

    /**
     * Set the four digit year option value.
     *
     * @param $value
     *
     * @return void
     */
    public function setYear4($value): void
    {
        $this->year_4 = $value;
        $this->buildOptions();
    }

    /**
     * Set the two digit year option value.
     *
     * @param $value
     *
     * @return void
     */
    public function setYear2($value): void
    {
        $this->year_2 = $value;
        $this->buildOptions();
    }

    /**
     * Set the two digit month option value.
     *
     * @param $value
     *
     * @return void
     */
    public function setMonth2($value): void
    {
        $this->month_2 = $value;
        $this->buildOptions();
    }

    /**
     * Set the single digit month option value.
     *
     * @param $value
     *
     * @return void
     */
    public function setMonth1($value): void
    {
        $this->month_1 = $value;
        $this->buildOptions();
    }

    /**
     * Set the full month name option value.
     *
     * @param $value
     *
     * @return void
     */
    public function setMonthFull($value): void
    {
        $this->month_full = $value;
        $this->buildOptions();
    }

    /**
     * Set the week option value.
     *
     * @param $value
     *
     * @return void
     */
    public function setWeek($value): void
    {
        $this->week = $value;
        $this->buildOptions();
    }

    /**
     * Set the increment option value.
     *
     * @param $value
     *
     * @return void
     */
    public function setIncrement($value): void
    {
        $this->increment = $value;
        $this->buildOptions();
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
