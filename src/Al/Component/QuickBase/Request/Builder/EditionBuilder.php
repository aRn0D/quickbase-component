<?php

namespace Al\Component\QuickBase\Request\Builder;

use Al\Component\QuickBase\Request\Builder\Base\AbstractBuilder;

class EditionBuilder extends AbstractBuilder
{
    /**
     * @var array
     */
    private $mapping;

    /**
     * @param $model
     * @return $this
     * @throws \RuntimeException
     */
    public function setModel($model)
    {
        if (!is_array($this->mapping)) {
            throw new \RuntimeException('Mapping configuration has not been set.');
        }

        foreach($this->mapping as $field) {
            $this->request->addCollectionParameter(
                'field',
                $this->getModelVale($model, $field['model']),
                array($this->getFieldAttributeName() => $field['quickbase']));
        }

        return $this;
    }

    /**
     * @param array $mapping
     * @return $this
     */
    public function setMapping(array $mapping)
    {
        $this->mapping = $mapping;

        return $this;
    }

    /**
     * Get the field attribute name
     *
     * @return string
     */
    private function getFieldAttributeName()
    {
        return $this->isStructured() ? 'fid' : 'name';
    }

    /**
     * Get the value
     *
     * @param $model
     * @param $property
     * @return mixed
     */
    private function getModelVale($model, $property)
    {
        $method = sprintf('get%s', ucfirst($property));

        return $model->$method();
    }
}
