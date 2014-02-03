<?php

namespace PHPocket\Widgets;
use PHPocket\IO\PrintWriterInterface;
use PHPocket\IO\PrintWriters\StringBuffer;

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
            self::$_currentGlobalContext = WidgetInterface::HTML_FULL;
        }

        return self::$_currentGlobalContext;
    }

    /**
     * Prints content of widget to provided printer
     *
     * @param PrintWriterInterface $writer
     * @param int                  $context
     * @return void
     */
    public function writeValue(PrintWriterInterface $writer, $context)
    {
        $writer->write($this->_safeValue($context));
    }

    /**
     * Returns value without exception
     *
     * @param int $context
     * @return string
     */
    protected function _safeValue($context)
    {
        try {
            return $this->getValue($context);
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function __toString()
    {
        $sb = new StringBuffer();
        $this->writeValue(
            $sb,
            self::getGlobalContext()
        );

        return $sb->getString();
    }

}