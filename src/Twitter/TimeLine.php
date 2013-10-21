<?php

namespace PHPocket\Widgets\Twitter;

use PHPocket\Widgets\Widget;

class TimeLine extends Widget
{
    const SCRIPT = "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\"://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>";

    protected $_widgetID;

    protected $_noHeader;
    protected $_noFooter;
    protected $_noScroll;
    protected $_noBorder;
    protected $_transparent;


    /**
     * Constructor
     *
     * @param string $widgetID
     * @param bool   $transparent
     * @param bool   $noHeader
     * @param bool   $noFooter
     * @param bool   $noBorder
     * @param bool   $noScroll
     */
    public function __construct(
        $widgetID,
        $transparent = false,
        $noHeader = false,
        $noFooter = false,
        $noBorder = false,
        $noScroll = false
    ) {
        $this->_widgetID = $widgetID;
        $this->_transparent = $transparent;
        $this->_noHeader = $noHeader;
        $this->_noFooter = $noFooter;
        $this->_noScroll = $noScroll;
        $this->_noBorder = $noBorder;
    }

    /**
     * Returns value of widget in requested context
     *
     * @param int $context
     *
     * @return string|array|null Null returned for no content
     */
    public function getValue($context)
    {
        switch ($context) {
            case self::HTML_FULL:
            case self::HTML_SIMPLIFIED:
                return '<a class="twitter-timeline" href="https://twitter.com/"'
                    . 'data-widget-id="' . $this->_widgetID . '"'
                    . 'data-chrome="'
                    . ($this->_transparent ? 'transparent ' : '')
                    . ($this->_noHeader ? 'noheader ' : '')
                    . ($this->_noFooter ? 'nofooter ' : '')
                    . ($this->_noBorder ? 'noborders ' : '')
                    . ($this->_noScroll ? 'noscrollbar ' : '')
                    . '">&nbsp;</a>' . PHP_EOL
                    . self::SCRIPT . PHP_EOL;
            default:
                return $this->_widgetID;
        }
    }


}