<?php

namespace App\PortfolioManagementContext\Application\Command\Order;

use App\PortfolioManagementContext\Domain\Command\Order\CreateOrderCommand;
use App\PortfolioManagementContext\Domain\Exception\AllocationNotFoundException;
use App\PortfolioManagementContext\Domain\Exception\InvalidTypeException;
use App\PortfolioManagementContext\Domain\Exception\PortfolioNotFoundException;
use App\PortfolioManagementContext\Domain\Model\Order\Order;
use App\PortfolioManagementContext\Domain\Model\Order\OrderRepository;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

class CreateOrderCommandHandler implements CommandHandler
{

    private OrderRepository $orderRepository;

    private PortfolioRepository $portfolioRepository;

    public function __construct(OrderRepository $orderRepository, PortfolioRepository $portfolioRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->portfolioRepository = $portfolioRepository;
    }

    public function __invoke(CreateOrderCommand $command): void
    {
        if ($command->getType() != Order::BUY_ORDER && $command->getType() !== Order::SELL_ORDER)
            throw new InvalidTypeException();

        $portfolio = $this->portfolioRepository->byId($command->getPortfolioId());
        if (!$portfolio)
            throw new PortfolioNotFoundException();

        $order = new Order($command->getId(), $command->getPortfolioId(), $command->getAllocationId(), $command->getShares(), $command->getType());

        $this->orderRepository->save($order);
    }


}