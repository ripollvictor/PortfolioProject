<?php

namespace App\PortfolioManagementContext\Application\Query\Order;

use App\PortfolioManagementContext\Domain\Model\Order\OrderRepository;
use App\PortfolioManagementContext\Domain\Query\FindAllOrdersQuery;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Infrastructure\Bus\Query\JsonResponse;

class FindAllOrdersQueryHandler implements QueryHandler
{

    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function __invoke(FindAllOrdersQuery $query): ?Response
    {
        $order = $this->orderRepository->all();

        return new JsonResponse($order);
    }


}