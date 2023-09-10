<?php
namespace Training\Seller\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    public function __construct(
        ActionFactory $actionFactory
    )
    {
        $this->actionFactory=$actionFactory;
    }

    public function match(RequestInterface $request): ?ActionInterface
    {
        $url = $request->getPathInfo();

        if($url==='/sellers.html'){
            $request->setPathInfo('/seller/seller/index');
            return $this->actionFactory->create(Forward::class);
        }

        if (preg_match('%^/seller/(.+)\.html$%', $url, $match)) {
            $request->setPathInfo(sprintf('/seller/seller/view/identifier/%s', $match[1]));
            return $this->actionFactory->create(Forward::class);
        }

        return null;

        // TODO: Implement match() method.
    }
}
