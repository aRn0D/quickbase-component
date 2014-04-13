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

use Al\Component\QuickBase\Request\Builder\Base\BuilderInterface;
use Al\Component\QuickBase\Request\Builder\Factory\BuilderFactoryInterface;
use Al\Component\QuickBase\Request\Builder\QueryBuilder;
use Al\Component\QuickBase\Client\Client;
use Al\Component\QuickBase\Request\Request;
use Al\Component\QuickBase\Model\Manager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositorySpec extends ObjectBehavior
{
    function let(
        QueryBuilder $queryBuilder,
        Manager $manager,
        BuilderFactoryInterface $factory,
        Client $client
    ) {
        $queryBuilder->createRequest(BuilderInterface::QUERY)->willReturn($queryBuilder);
        $factory->get('query')->willReturn($queryBuilder);
        $manager->getBuilderFactory()->willReturn($factory);
        $manager->getClient()->willReturn($client);

        $this->beConstructedWith($manager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Model\Repository');
    }

    function it_find_a_single_resource(
        QueryBuilder $queryBuilder,
        Request $request,
        Client $client
    ) {
        $queryBuilder->select()
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->where(Argument::type('Al\Component\QuickBase\Request\Builder\Query\Criteria'))
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->andWhere(Argument::type('Al\Component\QuickBase\Request\Builder\Query\Criteria'))
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->getRequest()
            ->shouldBeCalled()
            ->willreturn($request);

        $client->send($request)->shouldBeCalled();

        $this->findOneBy(array(
            1 => 'value',
            11 => 'value'
        ));
    }

    function it_find_a_collection_of_resource(
        QueryBuilder $queryBuilder,
        Request $request,
        Client $client
    ) {
        $queryBuilder->select()
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setLimit(null)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setOffset(null)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->sortBy(array())
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->getRequest()
            ->shouldBeCalled()
            ->willreturn($request);

        $client->send($request)->shouldBeCalled();

        $this->findBy();
    }

    function it_find_a_collection_of_resource_with_criteria(
        QueryBuilder $queryBuilder,
        Request $request,
        Client $client
    ) {
        $queryBuilder->select()
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setLimit(null)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setOffset(null)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->sortBy(array())
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->where(Argument::type('Al\Component\QuickBase\Request\Builder\Query\Criteria'))
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->getRequest()
            ->shouldBeCalled()
            ->willreturn($request);

        $client->send($request)->shouldBeCalled();

        $this->findBy(array(1 => 'value'));
    }

    function it_find_a_collection_of_resource_with_pagination(
        QueryBuilder $queryBuilder,
        Request $request,
        Client $client
    ) {
        $queryBuilder->select()
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setLimit(10)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setOffset(1)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->sortBy(array())
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->getRequest()
            ->shouldBeCalled()
            ->willreturn($request);

        $client->send($request)->shouldBeCalled();

        $this->findBy(array(), 1, 10);
    }

    function it_find_a_collection_of_resource_with_sorting(
        QueryBuilder $queryBuilder,
        Request $request,
        Client $client
    ) {
        $queryBuilder->select()
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setLimit(null)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->setOffset(null)
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->sortBy(array(
            1 =>'sortorder-A',
            11 => 'sortorder-D'
        ))
            ->shouldBeCalled()
            ->willReturn($queryBuilder);

        $queryBuilder->getRequest()
            ->shouldBeCalled()
            ->willreturn($request);

        $client->send($request)->shouldBeCalled();

        $this->findBy(array(), null, null, array(
            1 => QueryBuilder::SORT_ASC,
            11 => QueryBuilder::SORT_DESC
        ));
    }
}
