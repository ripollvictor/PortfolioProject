<?php

namespace App\ApiContext\Infrastructure;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiBaseController extends AbstractController
{
    protected CommandBus $commandBus;
    protected QueryBus $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }


}