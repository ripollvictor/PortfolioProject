<?php

namespace App\PortfolioManagementContext\Application\Command\Order;

use App\PortfolioManagementContext\Domain\Command\Order\CreateOrderCommand;
use App\PortfolioManagementContext\Domain\Model\Order\Order;
use App\PortfolioManagementContext\Domain\Model\Order\OrderRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

class CreateOrderCommandHandler implements CommandHandler
{

    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(CreateOrderCommand $command): void
    {
        $order = new Order($command->getId(), $command->getPortfolioId(), $command->getAllocationId(), $command->getShares(), $command->getType());
        $this->orderRepository->save($order);
    }


}