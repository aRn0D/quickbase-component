<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Exception;

use PhpSpec\ObjectBehavior;

class ClientConfigurationExceptionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('wrongParam');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Exception\ClientConfigurationException');
    }

    public function it_is_exception()
    {
        $this->shouldHaveType('\Exception');
    }
}
