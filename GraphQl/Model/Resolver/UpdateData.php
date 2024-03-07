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
class UpdateData implements ResolverInterface
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

        $id = $args['input']['id'];
        $data = $this->dataFactory->create()->load($id);
        if (!$data->getId()) {
            throw new \Exception('Data not found.');
        }

        if (isset($args['input']['name'])) {
            $data->setName($args['input']['name']);
        }
        if (isset($args['input']['gender'])) {
            $data->setGender($args['input']['gender']);
        }
        if (isset($args['input']['email'])) {
            $data->setEmail($args['input']['email']);
        }
        if (isset($args['input']['status'])) {
            $data->setStatus($args['input']['status']);
        }
        if (isset($args['input']['feedback'])) {
            $data->setFeedback($args['input']['feedback']);
        }

        $data->save();

        return [
            'id' => $data->getId(),
            'name' => $data->getName(),
            'gender' => $data->getGender(),
            'email' => $data->getEmail(),
            'status' => $data->getStatus(),
            'feedback' => $data->getFeedback()
        ];

    }


}
