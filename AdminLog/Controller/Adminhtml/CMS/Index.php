<?php

namespace Pasha\AdminLog\Controller\Adminhtml\CMS;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;

class Index extends Action
{
    private PageFactory $pageFactory;
    public function __construct (
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Admin Action Log CMS Page'));

        return $resultPage;
    }
}
