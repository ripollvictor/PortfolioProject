<?php

namespace App\PortfolioManagementContext\Application\Command\Order;

use App\PortfolioManagementContext\Domain\Command\Order\CompleteOrderCommand;
use App\PortfolioManagementContext\Domain\Exception\OrderNotFoundException;
use App\PortfolioManagementContext\Domain\Exception\PortfolioNotFoundException;
use App\PortfolioManagementContext\Domain\Model\Order\Order;
use App\PortfolioManagementContext\Domain\Model\Order\OrderRepository;
use App\PortfolioManagementContext\Domain\Model\Portfolio\Allocation;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\UuidGenerator;

class CompleteOrderCommandHandler implements CommandHandler
{
    private OrderRepository $orderRepository;
    private PortfolioRepository $portfolioRepository;

    private UuidGenerator $uuidGenerator;

    public function __construct(OrderRepository $orderRepository, PortfolioRepository $portfolioRepository, UuidGenerator $uuidGenerator)
    {
        $this->orderRepository = $orderRepository;
        $this->portfolioRepository = $portfolioRepository;
        $this->uuidGenerator = $uuidGenerator;
    }


    public function __invoke(CompleteOrderCommand $command): void
    {
        $order = $this->orderRepository->byId($command->getId());

        if (!$order) {
            throw new OrderNotFoundException();
        }

        $order->setCompleted($command->isCompleted());

        $this->managePortfolio($order);
        $this->orderRepository->save($order);
    }

    private function managePortfolio(Order $order): void
    {
        $portfolio = $this->portfolioRepository->byId($order->getPortfolioId());

        if (!$portfolio)
            throw new PortfolioNotFoundException();

        if ($order->getType() === Order::SELL_ORDER) {
            $allocation = $portfolio->getAllocation($order->getAllocationId());
            if ($allocation)
                $portfolio->removeAllocation($allocation);
        }

        if ($order->getType() === Order::BUY_ORDER) {
            $allocation = new Allocation($order->getAllocationId(), $order->getShares(), $portfolio);
            $portfolio->addAllocation($allocation);
        }

        $this->portfolioRepository->save($portfolio);

    }


}