<?php
namespace Training\AdminLogs\Plugin;

use Magento\Backend\Model\Auth\Session;
use Training\AdminLogs\Helper\Data;
use Training\AdminLogs\Model\UserActionFactory;

class LogoutPlugin
{
    protected $userActionFactory;

    protected $helper;

    public function __construct(UserActionFactory $userActionFactory,Data $helper,)
    {
        $this->userActionFactory = $userActionFactory;
        $this->helper=$helper;

    }

    public function beforeProcessLogout(Session $subject)
    {
        if (!$this->helper->isTrackingEnabled()){
            $this->logger->info('Admin Logs module is disabled');
            return null;
        }
        if (!$this->helper->isLoginActivityEnabled()) {
            $this->logger->info('Login module is disabled');
            return null;
        }
        // Get the admin user session
        $adminUserSession = $subject->getUser();

        // Get the admin user ID
        $userId = $adminUserSession->getId();

        //retrieve the userAction
        $userAction = $this->userActionFactory->create()
            ->getCollection()
            ->addFieldToFilter('user_id', $userId)
            ->getFirstItem();

        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');

        // Store the logout datetime in the user_action table
        $userAction->setData([
            'logout_date' => $currentDateTime,
        ]);
        $userAction->save();

        return null; // Make sure to return null to not affect the original method.
    }
}
