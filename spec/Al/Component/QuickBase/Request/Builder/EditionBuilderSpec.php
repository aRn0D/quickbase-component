<?php

namespace spec\Al\Component\QuickBase\Request\Builder;

use PhpSpec\ObjectBehavior;
use spec\Al\Component\QuickBase\Fixture\Model;

class EditionBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Builder\EditionBuilder');
    }

    public function it_is_a_builder()
    {
        $this->shouldHaveType('Al\Component\QuickBase\Request\Builder\Base\AbstractBuilder');
    }

    public function it_create_request()
    {
        $this->createRequest('action')->shouldReturn($this);
    }

    public function it_has_no_request_by_default()
    {
        $this->getRequest()->shouldReturn(null);
    }

    public function it_has_request()
    {
        $this->createRequest('action');
        $this->getRequest()->shouldHaveType('Al\Component\QuickBase\Request\Request');
    }

    public function it_is_a_structured_query()
    {
        $this->createRequest('action')
            ->setStructured(true)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'fmt' => 'structured'
        ));
        $this->isStructured()->shouldReturn(true);
    }

    public function it_is_not_a_structured_query()
    {
        $this->createRequest('action')
            ->setStructured(false)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array());
        $this->isStructured()->shouldReturn(false);
    }

    public function it_has_mapping()
    {
        $this->setMapping(array())->shouldReturn($this);
    }

    public function it_has_model(Model $model)
    {
        $model->getProperty()->willReturn('property');
        $model->getId()->willreturn(12);

        $this->createRequest('action')
            ->setMapping(array(
                array(
                    'quickbase' => 'quickbaseid',
                    'model' => 'id',
                ),
                array(
                    'quickbase' => 'quickbaseProperty',
                    'model' => 'property',
                ))
            )
            ->shouldReturn($this);

        $this->createRequest('action')
            ->setModel($model)
            ->shouldReturn($this);

        $this->getRequest()->getParameters()->shouldReturn(array(
            'field' => array(
                array(
                    'attributes' => array('name' => 'quickbaseid'),
                    'values' => 12
                ),
                array(
                    'attributes' => array('name' => 'quickbaseProperty'),
                    'values' => 'property'
                )
            )
        ));
    }
}
