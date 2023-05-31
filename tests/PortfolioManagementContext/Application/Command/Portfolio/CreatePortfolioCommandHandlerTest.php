<?php

namespace App\Tests\PortfolioManagementContext\Application\Command\Portfolio;

use App\PortfolioManagementContext\Application\Command\Portfolio\CreatePortfolioCommandHandler;
use App\PortfolioManagementContext\Domain\Command\Portfolio\CreatePortfolioCommand;
use App\PortfolioManagementContext\Domain\Exception\EntityAlreadyExistsException;
use App\PortfolioManagementContext\Domain\Model\Portfolio\Portfolio;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use PHPUnit\Framework\TestCase;

class CreatePortfolioCommandHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        $portfolioId = 'aPortfolioId';
        $command = new CreatePortfolioCommand($portfolioId);

        $existingPortfolio = new Portfolio($portfolioId);
        $portfolioRepositoryMock = $this->createMock(PortfolioRepository::class);
        $portfolioRepositoryMock->method('byId')
            ->with($portfolioId)
            ->willReturn($existingPortfolio);

        $portfolioRepositoryMock->expects($this->never())
            ->method('save');

        $handler = new CreatePortfolioCommandHandler($portfolioRepositoryMock);

        $this->expectException(EntityAlreadyExistsException::class);

        $handler->__invoke($command);
    }

    public function testInvokeWithNonExistingPortfolio(): void
    {
        $portfolioId = 'aPortfolioId';
        $command = new CreatePortfolioCommand($portfolioId);

        $portfolioRepositoryMock = $this->createMock(PortfolioRepository::class);
        $portfolioRepositoryMock->method('byId')
            ->with($portfolioId)
            ->willReturn(null);

        $portfolioRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Portfolio::class));

        $handler = new CreatePortfolioCommandHandler($portfolioRepositoryMock);

        $handler->__invoke($command);
    }
}

