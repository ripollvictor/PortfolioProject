<?php

namespace App\PortfolioManagementContext\Application\Command;

use App\PortfolioManagementContext\Domain\Command\Portfolio\UpdatePortfolioCommand;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Doctrine\ORM\EntityNotFoundException;

class UpdatePortfolioCommandHandler implements CommandHandler
{

    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function __invoke(UpdatePortfolioCommand $command): void
    {
        $portfolio = $this->portfolioRepository->byId($command->getId());

        if (!$portfolio) {
            throw new EntityNotFoundException;
        }

        $portfolio->setAllocations($command->getAllocations());

        $this->portfolioRepository->save($portfolio);
    }


}