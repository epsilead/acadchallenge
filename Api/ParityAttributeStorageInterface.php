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
namespace AR\AcadChallenge\Api;

/**
 * @api
 */
interface ParityAttributeStorageInterface
{
    /**
     * Get ParityAttribute entity.
     *
     * @param int $productId
     * @return mixed
     */
    public function get(int $productId);

    /**
     * Update all attributes.
     *
     * @param int $productId
     * @return mixed
     */
    public function update();

}
