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
use Al\Component\QuickBase\Request\Builder\Base\BuilderInterface;
use Al\Component\QuickBase\Request\Builder\EditionBuilder;
use Al\Component\QuickBase\Request\Builder\Factory\BuilderFactoryInterface;
use Al\Component\QuickBase\Client\Client;
use Al\Component\QuickBase\Request\Request;
use Al\Component\QuickBase\Response\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Al\Component\QuickBase\Fixture\Model;

class ManagerSpec extends ObjectBehavior
{
    function let(
        Client $client,
        BuilderFactoryInterface $builderFactory
    ) {
        $this->beConstructedWith(
            array(
                'spec\Al\Component\QuickBase\Fixture\Model' => array(
                    'repository' => 'spec\Al\Component\QuickBase\Fixture\Repository',
                    'mapping' => array(
                        array(
                            'quickbase' => 'id',
                            'model' => 'id',
                            'identifier' => 'model',
                        ),
                        array(
                            'quickbase' => 'quickbaseId',
                            'model' => 'quickbaseId',
                            'identifier' => 'quickbase',
                        ),
                        array(
                            'quickbase' => 'property',
                            'model' => 'property',
                        )
                    ),
                ),
                'spec\Al\Component\QuickBase\Fixture\MyModel'  => array(
                    'repository' => 'spec\Al\Component\QuickBase\Fixture\BadRepository',
                    'mapping' => array(

                    ),
                )
            ),
            $client,
            $builderFactory
        );
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
        $this->getBuilderFactory()
            ->shouldHaveType('Al\Component\QuickBase\Request\Builder\Factory\BuilderFactoryInterface');
    }

    function it_has_a_repository()
    {
        $this->getRepository('spec\Al\Component\QuickBase\Fixture\Model')
            ->shouldHaveType('spec\Al\Component\QuickBase\Fixture\Repository');
        $this->getRepository('spec\Al\Component\QuickBase\Fixture\OtherModel')
            ->shouldHaveType('Al\Component\QuickBase\Model\Repository');
    }

    function it_should_throw_exception_if_the_repository_is_not_valid()
    {
        $this->shouldThrow('\RuntimeException')->during('getRepository', array(
            'spec\Al\Component\QuickBase\Fixture\MyModel'
        ));
    }

    function it_create_a_resource(
        Model $model,
        BuilderFactoryInterface $builderFactory,
        EditionBuilder $editionBuilder,
        Request $request,
        Client $client,
        Response $response
    ) {
        $builderFactory->get('edition')
            ->shouldbeCalled()
            ->willReturn($editionBuilder);

        $editionBuilder->createRequest(BuilderInterface::ADD_RECORD)
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->setModel($model)
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->setMapping(Argument::any())
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->getRequest()
            ->shouldbeCalled()
            ->willReturn($request);

        $client->send($request)
            ->shouldbeCalled()
            ->willReturn($response);

        $this->create($model);
    }

    function it_update_a_resource(
        Model $model,
        BuilderFactoryInterface $builderFactory,
        EditionBuilder $editionBuilder,
        Request $request,
        Client $client,
        Response $response
    ) {
        $builderFactory->get('edition')
            ->shouldbeCalled()
            ->willReturn($editionBuilder);

        $editionBuilder->createRequest(BuilderInterface::EDIT_RECORD)
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->setModel($model)
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->setMapping(Argument::any())
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->getRequest()
            ->shouldbeCalled()
            ->willReturn($request);

        $client->send($request)
            ->shouldbeCalled()
            ->willReturn($response);

        $this->update($model);
    }

    function it_remove_a_resource(
        Model $model,
        BuilderFactoryInterface $builderFactory,
        EditionBuilder $editionBuilder,
        Request $request,
        Client $client,
        Response $response
    ) {
        $builderFactory->get('edition')
            ->shouldbeCalled()
            ->willReturn($editionBuilder);

        $editionBuilder->createRequest(BuilderInterface::DELETE_RECORD)
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->setModel($model)
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->setMapping(Argument::any())
            ->shouldbeCalled($model)
            ->willReturn($editionBuilder);

        $editionBuilder->getRequest()
            ->shouldbeCalled()
            ->willReturn($request);

        $client->send($request)
            ->shouldbeCalled()
            ->willReturn($response);

        $this->remove($model);
    }
}
