<?php

namespace Pasha\AdminLog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class View extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Backend::system';
    public function __construct(
        Context $context,
    ) {
        parent::__construct($context);
    }


    public function execute(): ResultInterface
    {
        $id = $this->getRequest()->getParam('id');
        try {
            /** @var Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result->setActiveMenu('Pasha_AdminLog::eventlog');
        } catch (NoSuchEntityException $e) {
            /** @var Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Admins logs with id "%value" does not exist.', ['value' => $id])
            );
            $result->setPath('*/*');
        }
        return $result;
    }
}
