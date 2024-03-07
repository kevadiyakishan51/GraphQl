<?php

namespace KK\Graphql\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use KK\Form\Model\DataFactory;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;

class GetDataById implements ResolverInterface
{
    protected $dataFactory;

    public function __construct(DataFactory $dataFactory)
    {
        $this->dataFactory = $dataFactory;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param \Magento\Framework\GraphQl\Config\Element\Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     */

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        $id = $args['id'];
        $data = $this->dataFactory->create()->load($id);
        return $data->getData();
    }
}