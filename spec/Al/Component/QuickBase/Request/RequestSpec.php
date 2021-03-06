<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Request;

use PhpSpec\ObjectBehavior;

class RequestSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('action');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Request');
    }

    public function it_has_no_host_by_default()
    {
        $this->getHost()->shouldReturn(null);
    }

    public function its_host_is_mutable()
    {
        $this->setHost('host')->shouldReturn($this);
        $this->getHost()->shouldReturn('host');
    }

    public function it_has_no_token_by_default()
    {
        $this->getToken()->shouldReturn(null);
    }

    public function its_token_is_mutable()
    {
        $this->setToken('token')->shouldReturn($this);
        $this->getToken()->shouldReturn('token');
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

    public function it_creates_a_collection_paramater()
    {
        $this->addCollectionParameter('parameter', 'value1')->shouldReturn($this);
        $this->addCollectionParameter('parameter', 'value2', array('id' => 'parameterId'))->shouldReturn($this);
        $this->getParameters()->shouldReturn(array(
            'parameter' => array(
                array('values' => 'value1'),
                array(
                    'values' => 'value2',
                    'attributes' => array('id' => 'parameterId')
                ),
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

    public function it_has_body()
    {
        $this->getBody();
    }
}
