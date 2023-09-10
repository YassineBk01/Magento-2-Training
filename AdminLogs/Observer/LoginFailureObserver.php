<?php
namespace Training\AdminLogs\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Training\AdminLogs\Helper\Data;
use Training\AdminLogs\Model\UserActionFactory;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class LoginFailureObserver implements ObserverInterface
{
    protected $logger;
    protected $userActionFactory;
    protected $session;
    protected $helper;
    protected $remoteAddress;
    protected $request;

    public function __construct(
        LoggerInterface $logger,
        UserActionFactory $userActionFactory,
        Session $session,
        Data $helper,
        RemoteAddress $remoteAddress,
        \Magento\Framework\App\Request\Http $request,
    ) {
        $this->logger = $logger;
        $this->userActionFactory = $userActionFactory;
        $this->session = $session;
        $this->helper = $helper;
        $this->remoteAddress = $remoteAddress;
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {

        if (!$this->helper->isTrackingEnabled()){
            $this->logger->info('Admin Logs module is disabled');
            return;
        }
        $moduleName = $this->request->getModuleName();

        if (!$this->helper->isLoginActivityEnabled()) {
            $this->logger->info('Login module is disabled');
            return;
        }

        try {
            $sessionId = $this->session->getSessionId();
            $user = $observer->getEvent()->getUser();
            $ipAddress = $this->remoteAddress->getRemoteAddress();


            $userAction = $this->userActionFactory->create();
            $userAction->setLoginDate(date('Y-m-d H:i:s'));
            $userAction->setUsername($user->getUsername());
            $userAction->setSessionId($sessionId);
            $userAction->setUserId($user->getId());
            $userAction->setEmail($user->getEmail());
            $userAction->setIpAddress($ipAddress);
            $userAction->setActionType('login_failed');
            $userAction->setAffectedModule('backend');

            $userAction->save();

            $this->logger->info('Failed login activity logged for username: ' . $user->getUsername());
        } catch (\Exception $e) {
            $this->logger->error('Error logging failed login activity: ' . $e->getMessage());
        }
    }
}
