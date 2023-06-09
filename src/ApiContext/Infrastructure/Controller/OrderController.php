<?php

namespace App\ApiContext\Infrastructure\Controller;

use App\ApiContext\Infrastructure\ApiBaseController;
use App\PortfolioManagementContext\Domain\Command\Order\CompleteOrderCommand;
use App\PortfolioManagementContext\Domain\Command\Order\CreateOrderCommand;
use App\PortfolioManagementContext\Domain\Query\FindAllOrdersQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OrderController extends ApiBaseController
{

    /**
     * @Route("/order", name="create_order", methods={"POST"})
     */
    public function createOrder(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $this->commandBus->dispatch(new CreateOrderCommand($data['id'], $data['portfolioId'], $data['allocationId'], $data['shares'], $data['type']));

        return $this->json([], Response::HTTP_CREATED);
    }

    /**
     * @Route("/order/{id}", name="order", methods={"PATCH"})
     */
    public function updateOrder(Request $request, string $id): Response
    {
        $data = json_decode($request->getContent(), true);

        try {
            $this->commandBus->dispatch(new CompleteOrderCommand($id, $data['status'] === 'completed'));
        } catch (\Throwable $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new Response(null, Response::HTTP_OK);
    }

    /**
     * @Route("/order", name="get_orders", methods={"GET"})
     */
    public function getOrders(): Response
    {
        $response = $this->queryBus->ask(new FindAllOrdersQuery());

        return new Response($response->json(), $response->status(), [
            'Content-Type' => 'application/json'
        ]);
    }


}
