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
namespace AR\AcadChallenge\Model\Product;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use AR\AcadChallenge\Api\Data\ParityAttributeInterface;
use AR\AcadChallenge\Api\ParityAttributeStorageInterface;
use AR\AcadChallenge\Model\Product\ResourceModel\ParityAttribute as ParityAttributeResource;
use Magento\Framework\EntityManager\EntityManager;

/**
 * Class ParityAttributeStorage
 * @package AR\AcadChallenge\Model\Product
 */
class ParityAttributeStorage implements ParityAttributeStorageInterface
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @var ParityAttributeResource
     */
    private ParityAttributeResource $parityAttributeResource;

    /**
     * @var ParityAttributeFactory
     */
    private ParityAttributeFactory $parityAttributeFactory;

    /**
     * @var ProductCollectionFactory
     */
    private ProductCollectionFactory $productCollectionFactory;

    /**
     * ParityAttributeStorage constructor.
     *
     * @param EntityManager $entityManager
     * @param ParityAttributeFactory $parityAttributeFactory
     * @param ParityAttributeResource $parityAttributeResource
     * @param ProductCollectionFactory $productCollectionFactory
     */
    public function __construct(
        EntityManager $entityManager,
        ParityAttributeFactory $parityAttributeFactory,
        ParityAttributeResource $parityAttributeResource,
        ProductCollectionFactory $productCollectionFactory
    )
    {
        $this->entityManager = $entityManager;
        $this->parityAttributeFactory = $parityAttributeFactory;
        $this->parityAttributeResource = $parityAttributeResource;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * Get ParityAttribute by Product Id.
     *
     * @param int $productId
     * @return ParityAttributeInterface|null
     * @throws \Exception
     */
    public function get(int $productId)
    {
        $attributeId = $this->parityAttributeResource->getAttributeIdByProduct($productId);

        if ($attributeId) {
            $parityAttribute = $this->parityAttributeFactory->create();
            /** @var ParityAttributeInterface $attribute */
            return $this->entityManager->load($parityAttribute, $attributeId);
        }
        return null;
    }

    /**
     * Update All Parity Attributes.
     *
     * @throws \Exception
     */
    public function update()
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $collection */
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('entity_id');
        $ids = $collection->getAllIds();

        if ( count( $ids ) ) {
            foreach ( $ids as $productId ) {
                $this->save($productId);
            }
        }
    }

    /**
     * Save ParityAttribute using Product Id.
     *
     * @param int $productId
     * @return mixed|null
     * @throws \Exception
     */
    public function save(int $productId)
    {
        $attributeId = $this->parityAttributeResource->getAttributeIdByProduct($productId);
        if ( null == $attributeId ) {
            /** @var ParityAttribute $parityAttribute */
            $parityAttribute = $this->parityAttributeFactory->create();
            $parityAttribute->setProductId($productId);

            $parity = ($productId % 2) ? 0 : 1;
            $parityAttribute->setResult($parity);

            $this->entityManager->save($parityAttribute);
            return $parityAttribute->getId();
        }
        return null;
    }
}
