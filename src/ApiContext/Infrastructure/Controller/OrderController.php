<?php

namespace App\ApiContext\Infrastructure\Controller;

use App\ApiContext\Infrastructure\ApiBaseController;
use App\PortfolioManagementContext\Domain\Command\Order\CompleteOrderCommand;
use App\PortfolioManagementContext\Domain\Command\Order\CreateOrderCommand;
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

        $this->commandBus->dispatch(new CreateOrderCommand($data['id'], $data['portfolio'], $data['allocation'], $data['shares'], $data['type']));

        return $this->json([], Response::HTTP_CREATED);
    }

    /**
     * @Route("/order/{id}", name="update_order", methods={"PATCH"})
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


}
