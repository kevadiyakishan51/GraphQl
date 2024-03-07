<?php

declare(strict_types=1);

namespace KK\GraphQl\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use KK\Form\Model\DataFactory;

/**
 * Class BlogDetails
 */
class CreateData implements ResolverInterface
{

    /**
     * DataFactory
     *
     * @var $dataFactory
     */
    private $dataFactory;


    /**
     * Constructor
     *
     * @param DataFactory $dataFactory DataFactory.
     */
    public function __construct(
        DataFactory $dataFactory
    ) {
        $this->dataFactory = $dataFactory;

    }


    /**
      * Resolve Function
      *
      * @param Field       $field   Field.
      * @param Context     $context Context.
      * @param ResolveInfo $info    ResolveInfo.
      * @param array       $value   Array.
      * @param array       $args    Array.
      *
      * @throws GraphQlInputException GraphQlInputException.
      * @throws GraphQlNoSuchEntityException GraphQlNoSuchEntityException.
      *
      * @return array
      */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value=null,
        array $args=null
    ) {

        $formData = $args['input'];
        $post = $this->dataFactory->create();
        $post->setData($formData);
        return $post->save();
    }


}
