<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Request\Builder\Factory;

use PhpSpec\ObjectBehavior;

class BuilderFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Builder\Factory\BuilderFactory');
    }

    public function it_is_a_factory()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Builder\Factory\BuilderFactoryInterface');
    }

    public function it_create_a_builder()
    {
        $this->get('query')->shouldHaveType('Al\Component\QuickBase\Request\Builder\QueryBuilder');
    }
}
