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
namespace AR\AcadChallenge\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * @api
 */
interface ParityAttributeInterface extends ExtensibleDataInterface
{
    const ATTR_CODE = "parity_custom_attribute";

    const ATTR_ID = "id";

    const PRODUCT_ID = "product_id";

    const RESULT = 'result';

    /**
     * Return value.
     *
     * @return string|null
     */
    public function getResult();

    /**
     * Set value.
     *
     * @param string|null $value
     * @return $this
     */
    public function setResult($value);

    /**
     * Return Product Id.
     *
     * @return mixed
     */
    public function getProductId();

    /**
     * Set Product Id.
     *
     * @param int $productId
     * @return mixed
     */
    public function setProductId(int $productId);
}
