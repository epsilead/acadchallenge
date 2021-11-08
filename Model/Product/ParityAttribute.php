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

use Magento\Framework\Model\AbstractModel;
use AR\AcadChallenge\Api\Data\ParityAttributeInterface;
use AR\AcadChallenge\Model\Product\ResourceModel\ParityAttribute as ParityAttributeResource;

/**
 * Class ParityAttribute
 * @package AR\AcadChallenge\Model\Product
 */
class ParityAttribute extends AbstractModel implements ParityAttributeInterface
{
    const CACHE_TAG = 'ar_acad_challenge_parity';

    protected $_cacheTag = 'ar_acad_challenge_parity';

    protected $_eventPrefix = 'ar_acad_challenge_parity';

    /**
     * ParityAttribute Сonstructor.
     */
    protected function _construct()
    {
        $this->_init(ParityAttributeResource::class);
    }

    /**
     * Get result.
     *
     * @return array|mixed|string|null
     */
    public function getResult()
    {
        return $this->getData(self::RESULT);
    }

    /**
     * Set result.
     *
     * @param string|null $value
     * @return ParityAttribute
     */
    public function setResult($value)
    {
        return $this->setData(self::RESULT, $value);
    }

    /**
     * Get Product Id.
     *
     * @return array|mixed|null
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Set Product Id.
     *
     * @param int $value
     * @return ParityAttribute|mixed
     */
    public function setProductId($value)
    {
        return $this->setData(self::PRODUCT_ID, $value);
    }
}
