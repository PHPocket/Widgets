<?php

namespace PHPocket\Widgets\Documents;

use PHPocket\Widgets\Documents\Components\Data;
use PHPocket\Widgets\WidgetInterface;

/**
 * Base document
 * Used as content storage
 *
 * @package PHPocket\Widgets\Documents
 */
abstract class Document implements WidgetInterface
{

    /**
     * Common data
     *
     * @var Data
     */
    public $data;
    /**
     * Models data
     *
     * @var Data
     */
    public $models;
    /**
     * Text data
     *
     * @var Data
     */
    public $texts;
    /**
     * Settings data
     *
     * @var Data
     */
    public $settings;
    /**
     * Performance associative array
     *
     * @var array
     */
    public $performance;

    /**
     * Constructor
     * Sets root to self
     *
     * @param Document $prev Previous document
     */
    public function __construct(Document $prev = null)
    {
        if ($prev !== null) {
            $this->linkDataFrom($prev);
        } else {
            // We are first element
            $this->data = new Data();
            $this->models = new Data();
            $this->texts = new Data();
            $this->settings = new Data();
            $this->performance = array();
        }
    }

    public function linkDataFrom(Document $doc)
    {
        $this->data = $doc->data;
        $this->models = $doc->models;
        $this->texts = $doc->texts;
        $this->settings = $doc->settings;
        $this->performance = &$doc->performance;
    }

    /**
     * @return string
     */
    public final function __toString()
    {
        try{
            return $this->getValue(self::HTML_FULL);
        } catch( \Exception $e ) {
            // TODO Exception rendering
            return '';
        }
    }
}