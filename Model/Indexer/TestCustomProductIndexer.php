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
namespace AR\AcadChallenge\Model\Indexer;

use AR\AcadChallenge\Model\Product\ParityAttributeStorage;
use Magento\Framework\Indexer\ActionInterface as IndexerActionInterface;
use Magento\Framework\Mview\ActionInterface as MviewActionInterface;
use Psr\Log\LoggerInterface;

/**
 * Class TestCustomProductIndexer
 * @package AR\AcadChallenge\Model\Indexer
 */
class TestCustomProductIndexer implements IndexerActionInterface, MviewActionInterface
{
    /**
     * @var ParityAttributeStorage
     */
    private ParityAttributeStorage $parityAttributeStorage;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $psrLogger;

    /**
     * TestCustomProductIndexer Constructor.
     *
     * @param ParityAttributeStorage $parityAttributeStorage
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(
        ParityAttributeStorage $parityAttributeStorage,
        LoggerInterface $loggerInterface
    )
    {
        $this->parityAttributeStorage = $parityAttributeStorage;
        $this->psrLogger = $loggerInterface;
    }

    /**
     * Process indexer in the "Update on schedule" mode.
     *
     * @param int[] $ids
     */
    public function execute($ids)
    {
        $this->psrLogger->debug('AcadChallenge: TestCustomProductIndexer::execute');
    }

    /**
     * Reindex via command line.
     *
     * @throws \Exception
     */
    public function executeFull()
    {
        $this->psrLogger->debug('AcadChallenge: TestCustomProductIndexer::executeFull');
        $this->parityAttributeStorage->update();
    }

    /**
     * Running indexer for list of entities.
     *
     * @param array $ids
     */
    public function executeList(array $ids)
    {
        $this->psrLogger->debug('AcadChallenge: TestCustomProductIndexer::executeList');
    }

    /**
     * Running indexer for a single entity.
     *
     * @param int $id
     */
    public function executeRow($id)
    {
        $this->psrLogger->debug('AcadChallenge: TestCustomProductIndexer::executeRow');
    }
}
