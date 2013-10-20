<?php

namespace PHPocket\Widgets;

/**
 * Static container for current global display context
 * You can override it value by calling
 * Widget::setGlobalContext(), the argument MUST be one
 * of the WidgetInterface's constants
 *
 * Also provides nice helpers for other widgets
 *
 * @package PHPocket\Widgets
 */
abstract class Widget implements WidgetInterface
{

    /**
     * Current global context
     *
     * @var int
     */
    static private $_currentGlobalContext = null;

    /**
     * Sets current global context
     *
     * @see WidgetInteface for details
     * @param int $value
     *
     * @return void
     */
    static public function setGlobalContext($value)
    {
        self::$_currentGlobalContext = $value;
    }

    /**
     * Returns current global display context
     * If not set before, tries to autodetect it
     *
     * @return int
     */
    static public function getGlobalContext()
    {
        if (empty(self::$_currentGlobalContext)) {
            // Autodetect & force HTML
            self::$_currentGlobalContext = WidgetInterface::HTML;
        }

        return self::$_currentGlobalContext;
    }

    /**
     * Converts boolean to string
     *
     * @param bool   $boolean
     * @param string $true
     * @param string $false
     * @return string
     */
    public function b2s($boolean, $true = 'true', $false = 'false')
    {
        return $boolean ? $true : $false;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function __toString()
    {
        try{
            $value = $this->getValue(self::getGlobalContext());
            if ($value === null) return '';
            return $value;
        } catch (\Exception $e) {
            return '';
        }
    }

}