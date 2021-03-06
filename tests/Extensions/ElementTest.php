<?php

namespace Tests\Extensions;

use Illuminate\Support\Arr;
use PHPUnit_Framework_TestCase;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

class ElementTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_be_created()
    {
        $button = new Element('BotMan Release');
        $this->assertInstanceOf(Element::class, $button);
    }

    /**
     * @test
     **/
    public function it_can_set_title()
    {
        $element = new Element('BotMan Release');

        $this->assertSame('BotMan Release', Arr::get($element->toArray(), 'title'));
    }

    /**
     * @test
     **/
    public function it_can_set_image_url()
    {
        $element = new Element('BotMan Release');
        $element->image('http://botman.io/img/botman-body.png');

        $this->assertSame('http://botman.io/img/botman-body.png', Arr::get($element->toArray(), 'image_url'));
    }

    /**
     * @test
     **/
    public function it_can_set_item_url()
    {
        $element = new Element('BotMan Release');
        $element->itemUrl('http://botman.io/');

        $this->assertSame('http://botman.io/', Arr::get($element->toArray(), 'item_url'));
    }

    /**
     * @test
     **/
    public function it_can_set_subtitle()
    {
        $element = new Element('BotMan Release');
        $element->subtitle('This is huge');

        $this->assertSame('This is huge', Arr::get($element->toArray(), 'subtitle'));
    }

    /**
     * @test
     **/
    public function it_can_add_a_button()
    {
        $template = new Element('Here are some buttons');
        $template->addButton(ElementButton::create('button1'));

        $this->assertSame('button1', Arr::get($template->toArray(), 'buttons.0.title'));
    }

    /**
     * @test
     **/
    public function it_can_add_multiple_buttons()
    {
        $template = new Element('Here are some buttons');
        $template->addButtons([ElementButton::create('button1'), ElementButton::create('button2')]);

        $this->assertSame('button1', Arr::get($template->toArray(), 'buttons.0.title'));
        $this->assertSame('button2', Arr::get($template->toArray(), 'buttons.1.title'));
    }

    /**
     * @test
     **/
    public function it_can_set_default_action()
    {
        $template = new Element('Element with default_action');
        $template->defaultAction(ElementButton::create(null)->url('https://botman.io'));

        $this->assertSame('web_url', Arr::get($template->toArray(), 'default_action.type'));
        $this->assertSame('https://botman.io', Arr::get($template->toArray(), 'default_action.url'));
    }
}
