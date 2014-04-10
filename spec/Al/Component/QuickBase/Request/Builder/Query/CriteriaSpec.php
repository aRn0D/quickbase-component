<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Request\Builder\Query;

use PhpSpec\ObjectBehavior;

class CriteriaSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1, 'value', 'CT');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Builder\Query\Criteria');
    }

    public function it_should_be_transform_as_string()
    {
        $this->toString()->shouldReturn("{'1'.CT.'value'}");
    }
}
