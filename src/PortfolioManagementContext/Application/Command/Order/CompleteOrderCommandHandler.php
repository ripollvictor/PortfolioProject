<?php

namespace App\PortfolioManagementContext\Application\Command\Order;

use App\PortfolioManagementContext\Domain\Command\Order\CompleteOrderCommand;
use App\PortfolioManagementContext\Domain\Model\Order\OrderRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Doctrine\ORM\EntityNotFoundException;

class CompleteOrderCommandHandler implements CommandHandler
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(CompleteOrderCommand $command): void
    {
        $order = $this->orderRepository->byId($command->getId());

        if (!$order) {
            throw new EntityNotFoundException;
        }

        $order->setCompleted($command->isCompleted());
        $this->orderRepository->save($order);
    }


}