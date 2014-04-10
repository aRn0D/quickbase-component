<?php

/*
 * This file is part of the Quickbase API package.
 *
 * (c) Langlade Arnaud
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Al\Component\QuickBase\Model;

use Al\Component\QuickBase\Request\Builder\AuthenticationBuilder;
use Al\Component\QuickBase\Request\Builder\Factory\BuilderFactoryInterface;
use Al\Component\QuickBase\Client\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ManagerSpec extends ObjectBehavior
{
    function let(
        Client $client,
        BuilderFactoryInterface $builderFactory,
        AuthenticationBuilder $authenticationBuilder
    ) {
        $builderFactory->get('authentication')
            ->shouldBeCalled()
            ->willReturn($authenticationBuilder);

        $client->authenticate($authenticationBuilder)
            ->shouldBeCalled();

        $this->beConstructedWith($client, $builderFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Model\Manager');
    }

    function it_has_http_client()
    {
        $this->getClient()->shouldHaveType('Al\Component\QuickBase\Client\Client');
    }

    function it_has_a_factory()
    {
        $this->getBuilderFactory()->shouldHaveType('Al\Component\QuickBase\Request\Builder\Factory\BuilderFactoryInterface');
    }

    function it_has_a_repository()
    {
        $this->getRepository()->shouldHaveType('Al\Component\QuickBase\Model\Repository');
        $this->getRepository('Al\Component\QuickBase\Model\Repository')->shouldHaveType('Al\Component\QuickBase\Model\Repository');
    }

    function it_should_throw_exception_if_the_repository_is_not_valid()
    {

    }

    function it_create_a_resource()
    {
        $this->create();
    }

    function it_update_a_resource()
    {
        $this->update();
    }

    function it_remove_a_resource()
    {
        $this->remove();
    }
}
