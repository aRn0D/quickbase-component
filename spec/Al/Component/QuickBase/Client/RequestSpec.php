<?php

namespace spec\Al\Component\QuickBase\Client;

use PhpSpec\ObjectBehavior;

class RequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('action');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Client\Request');
    }

    public function it_has_action()
    {
        $this->getAction()->shouldReturn('action');
    }

    public function it_has_no_paramters_by_default()
    {
        $this->getParameters()->shouldReturn(array());
    }

    public function it_return_a_parameter()
    {
        $this->addParameter('parameter', 'value')->shouldReturn($this);
        $this->getParameter('parameter')->shouldReturn('value');
    }

    public function its_paramters_is_mutable()
    {
        $this->addParameter('parameter', 'value')->shouldReturn($this);
        $this->getParameters()->shouldReturn(array('parameter' =>'value'));
    }

    public function it_appends_option_to_paramater()
    {
        $this->appendToParameter('parameter', 'value1')->shouldReturn($this);
        $this->appendToParameter('parameter', 'value2')->shouldReturn($this);
        $this->getParameters()->shouldReturn(array(
            'parameter' => array(
                'value1',
                'value2'
            )
        ));
    }

    public function it_checks_if_paramter_exists()
    {
        $this->addParameter('parameter', 'value')->shouldReturn($this);
        $this->hasParameter('parameter')->shouldReturn(true);
        $this->hasParameter('wrongParams')->shouldReturn(false);
    }

    public function it_clears_a_parameter()
    {
        $this->addParameter('clear', 'value')->shouldReturn($this);
        $this->addParameter('parameter', 'value')->shouldReturn($this);
        $this->clearParameter('clear')->shouldReturn($this);
        $this->getParameters('clear')->shouldReturn(array('parameter' => 'value'));
    }

    public function it_clears_parameters()
    {
        $this->addParameter('parameter', 'value')->shouldReturn($this);
        $this->clearParameters()->shouldReturn($this);
        $this->getParameters()->shouldReturn(array());
    }
}
