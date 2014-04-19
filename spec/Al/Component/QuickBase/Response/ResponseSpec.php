<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Response;

use PhpSpec\ObjectBehavior;

class ResponseSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith("
            <qdbapi>
                <action>API_Authenticate</action>
                <errcode>0</errcode>
                <errtext>No error</errtext>
                <ticket>6_bixpp46hv_bzy55g_twfvudfwuxu5dn7r96cpg3arkchvzteq</ticket>
                <userid>58421</userid>
            </qdbapi>
        ");
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Response\Response');
    }

    public function it_checks_if_a_error_occurs()
    {
        $this->isErrored()->shouldReturn(false);
    }

    public function it_finds_a_error_occurs()
    {
        $this->beConstructedWith("
            <qdbapi>
                <errcode>75</errcode>
            </qdbapi>
        ");

        $this->isErrored()->shouldReturn(true);
    }

    public function it_has_action()
    {
        $this->getAction()->shouldReturn('API_Authenticate');
    }

    public function it_has_error_message()
    {
        $this->beConstructedWith("
            <qdbapi>
                <errcode>75</errcode>
                <errtext>This is an error</errtext>
            </qdbapi>
        ");
        $this->getError()->shouldReturn(array(
            'code' => 75,
            'message' => 'This is an error'
        ));
    }

    public function it_has_typed_data()
    {
        $this->getData('userid', 'integer')->shouldReturn(58421);
    }

    public function it_has_data()
    {
        $this->getData('userid')->shouldHaveType('\SimpleXMLElement');
    }
}
