<?php

namespace App\ApiContext\Infrastructure\Controller;

use App\PortfolioManagementContext\Application\Query\FindPortafolioQuery;
use App\PortfolioManagementContext\Domain\Command\Portfolio\CreatePortfolioCommand;
use App\PortfolioManagementContext\Domain\Command\Portfolio\UpdatePortfolioCommand;
use App\PortfolioManagementContext\Domain\Model\Portfolio\Allocation;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PortfolioController extends AbstractController
{

    private CommandBus $commandBus;
    private QueryBus $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }


    /**
     * @Route("/portfolios", name="create_portfolio", methods={"POST"})
     */
    public function createPortfolio(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $this->commandBus->dispatch(new CreatePortfolioCommand($data['id']));

        return $this->json([], Response::HTTP_CREATED);
    }


    /**
     * @Route("/portfolios/{id}", name="get_portfolio", methods={"GET"})
     */
    public function getPortfolio(Request $request, string $id): Response
    {

        $response = $this->queryBus->ask(new FindPortafolioQuery($id));

        return new Response($response->json(), $response->status(), [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/portfolios/{id}", name="update_portfolio", methods={"PUT"})
     */
    public function updatePortfolio(Request $request, string $id): Response
    {
        $data = json_decode($request->getContent(), true);

        try{
            $serializer = SerializerBuilder::create()->build();
            $allocations = $serializer->fromArray($data['allocations'], 'array<' . Allocation::class . '>');

            $this->commandBus->dispatch(new UpdatePortfolioCommand($id, $allocations));
        } catch (\Throwable $e) {
            return $this->json(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new Response(null, Response::HTTP_OK);
    }

    /**
     * @Route("/portfolios/{id}", name="invalid_method")
     */
    public function invalidMethod(): Response
    {
        return new Response(null, Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
