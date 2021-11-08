<?php
/**
 * AR_AcadChallenge module
 *
 * @category  AR
 * @package   AR_AcadChallenge
 * @copyright 2021 Artem Rotmistrenko
 * @license
 * @author    Artem Rotmistrenko
 */
namespace AR\AcadChallenge\Plugin;

use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use AR\AcadChallenge\Api\ParityAttributeStorageInterface;
use AR\AcadChallenge\Model\Product\ParityAttribute;

/**
 * Class ProductRepositoryPlugin
 * @package AR\AcadChallenge\Plugin
 */
class ProductRepositoryPlugin
{
    /**
     * @var ProductExtensionFactory
     */
    private ProductExtensionFactory $extensionFactory;

    /**
     * @var ParityAttributeStorageInterface
     */
    private $parityAttributeRepository;

    /**
     * @param ProductExtensionFactory $extensionFactory
     * @param ParityAttributeStorageInterface $parityAttributeRepository;
     */
    public function __construct(
        ProductExtensionFactory $extensionFactory,
        ParityAttributeStorageInterface $parityAttributeRepository
    )
    {
        $this->extensionFactory = $extensionFactory;
        $this->parityAttributeRepository = $parityAttributeRepository;
    }

    /**
     * @param ProductRepositoryInterface $subject
     * @param $product
     * @return mixed
     */
    public function afterGet(
        ProductRepositoryInterface $subject,
        ProductInterface $product
    )
    {
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes = $extensionAttributes ? $extensionAttributes : $this->extensionFactory->create();

        /** @var ParityAttribute $attribute */
        $attribute = $this->parityAttributeRepository->get($product->getId());
        if ( $attribute ) {
        $value = $attribute->getResult();
            if ( null !== $value ) {
                $extensionAttributes->setData(ParityAttribute::ATTR_CODE, $value);
            }
        }
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }
}
