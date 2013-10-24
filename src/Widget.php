<?php

namespace PHPocket\Widgets;

use PHPocket\Widgets\Documents\Document;

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
     * @var Document
     */
    static protected $_currentDocument = null;

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
     * Raises dependency (if needed) and
     *
     * @return Hook[]
     */
    protected function getHooks()
    {
        return array();
    }

    /**
     * Prints contents of widget
     *
     * @param int|null $context
     * @return void
     */
    public function show($context = null)
    {
        if (empty($context)) {
            $context = self::getGlobalContext();
        }
        echo $this->getValue($context);
        foreach ($this->getHooks() as $hook) {
            echo  $hook->getValue($context);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public final function __toString()
    {
        $context = self::getGlobalContext();
        try {
            $value = $this->getValue($context);
            foreach ($this->getHooks() as $hook) {
                if (self::$_currentDocument !== null) {
                    // Registering
                    self::$_currentDocument->registerHook($hook);
                } else {
                    // Displaying
                    if (!$hook->isBuildOnly()) {
                        $value .= $hook->getValue($context);
                    }
                }
            }
            if ($value === null) return '';
            return $value;
        } catch (\Exception $e) {
            return '';
        }
    }

}