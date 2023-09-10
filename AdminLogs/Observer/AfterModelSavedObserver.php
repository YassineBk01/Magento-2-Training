<?php
namespace Training\AdminLogs\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Training\AdminLogs\Helper\Data;
use Training\AdminLogs\Model\UserActionFactory;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class AfterModelSavedObserver implements ObserverInterface
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
        $this->request= $request;
    }

    public function execute(Observer $observer)
    {

        if (!$this->helper->isTrackingEnabled()){
            $this->logger->info('Admin Logs module is disabled');
            return;
        }

        $object = $observer->getEvent()->getObject();
        $moduleName = $object->getEventPrefix();

        if (!$this->helper->isModuleAllowed($moduleName)) {
            $this->logger->info('Login module is disabled');
            return;
        }

        try {
            $sessionId = $this->session->getSessionId();
            $ipAddress = $this->remoteAddress->getRemoteAddress();


            $userAction = $this->userActionFactory->create();
            $userAction->setUsername($object->getUsername());
            $userAction->setSessionId($sessionId);
            $userAction->setUserId($object->getUserId());
            $userAction->setEmail($object->getEmail());
            $userAction->setIpAddress($ipAddress);
            if ($object->isNewObject()){
                $userAction->setActionType('Add Action');
            } else {
                $userAction->setActionType('Update Action');
            }
            $userAction->setAffectedModule('$moduleName');

            $userAction->save();

            $this->logger->info('Failed save activity logged for username: ' . $object->getUsername());
        } catch (\Exception $e) {
            $this->logger->error('Error logging save activity: ' . $e->getMessage());
        }
    }
}
