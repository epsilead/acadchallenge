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
namespace AR\AcadChallenge\Model\Product\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use AR\AcadChallenge\Api\Data\ParityAttributeInterface;

/**
 * Class ParityAttribute
 * @package AR\AcadChallenge\Model\Product\ResourceModel
 */
class ParityAttribute extends AbstractDb
{
    /**
     * Parity Attribute ResourceModel Constructor.
     */
    protected function _construct()
    {
        $this->_init('test_custom_product_index', ParityAttributeInterface::ATTR_ID);
    }

    /**
     * @param int $productId
     * @return string|null
     * @throws \Exception
     */
    public function getAttributeIdByProduct(int $productId)
    {
        $connection = $this->getConnection();
        $select = $connection
            ->select()
            ->from($this->_mainTable, ParityAttributeInterface::ATTR_ID)
            ->where(ParityAttributeInterface::PRODUCT_ID . ' = ?', $productId);
        $id = $connection->fetchOne($select);
        return $id ?: null;
    }
}
