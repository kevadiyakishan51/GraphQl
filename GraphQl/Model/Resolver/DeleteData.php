<?php

namespace KK\GraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\Exception\LocalizedException;
use KK\Form\Model\DataFactory;

class DeleteData implements ResolverInterface
{
    protected $dataFactory;

    public function __construct(DataFactory $dataFactory)
    {
        $this->dataFactory = $dataFactory;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $id = $args['id'];
        $data = $this->dataFactory->create()->load($id);

        if (!$data->getId()) {
            throw new LocalizedException(__('Data with ID %1 not found.', $id));
        }

        try {
            $data->delete();
            return ['success' => true, 'message' => 'Data deleted successfully.'];
        } catch (\Exception $e) {
            throw new LocalizedException(__('Could not delete data with ID %1.', $id));
        }
    }
}
