<?php

namespace PHPocket\Widgets\Tests\Video;

use PHPocket\Widgets\Video\Coub;

class CoubTest extends \PHPUnit_Framework_TestCase
{

    public function testIDResolve()
    {
        $this->assertSame('abcedfg12', Coub::resolveID('http://coub.com/view/abcedfg12'));
        $this->assertSame('abcedfg12', Coub::resolveID('https://coub.com/view/abcedfg12'));
        $this->assertSame('abcedfg12', Coub::resolveID('http://coub.com/embed/abcedfg12'));
        $this->assertSame('abcedfg12', Coub::resolveID('abcedfg12'));

        try {
            Coub::resolveID('http://youtube.com/embed/abcedfg12');
            $this->fail();
        } catch (\InvalidArgumentException $e){
            $this->assertTrue(true);
        }
    }

    public function testPlain()
    {
        $x = new Coub('http://coub.com/embed/557l1v80' , 20, 10);

        $this->assertSame('http://coub.com/view/557l1v80', $x->getValue(Coub::PLAINTEXT));
        $this->assertSame('http://coub.com/view/557l1v80', $x->getEntryUrl());
        $this->assertSame('http://coub.com/embed/557l1v80', $x->getEmbedUrl());
    }

    public function testHTML()
    {
        $x = new Coub('http://coub.com/embed/557l1v80' , 20, 10);
        $this->assertSame('<iframe src="http://coub.com/embed/557l1v80?muted=false&autostart=false&noSiteButtons=false&hideTopBar=false&startWithHD=false" allowfullscreen="true" frameborder="0" width="20" height="10"></iframe>', $x->getValue(Coub::HTML_FULL));
        $x = new Coub('http://coub.com/embed/557l1v80' , 20, 10, true, true, true, true, true);
        $this->assertSame('<iframe src="http://coub.com/embed/557l1v80?muted=true&autostart=true&noSiteButtons=true&hideTopBar=true&startWithHD=true" allowfullscreen="true" frameborder="0" width="20" height="10"></iframe>', $x->getValue(Coub::HTML_FULL));
        $this->assertSame($x->getValue(Coub::HTML), $x->getValue(Coub::HTML_FULL));
        $this->assertSame($x->getValue(Coub::HTML), $x->getValue(Coub::HTML_SIMPLIFIED));
    }

}