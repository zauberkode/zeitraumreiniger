<?php

namespace App\Tests\Application\UseCase\Command\Period\Reset;

use App\Application\UseCase\Command\Period\Reset\ResetPeriodUseCase;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class ResetPeriodUseCaseTest extends TestCase
{
    private ResetPeriodUseCase $useCase;

    private Filesystem $filesystem;

    protected function setUp(): void
    {
        $this->filesystem = $this->createMock(Filesystem::class);
        $this->filesystem->expects($this->exactly(3))->method('exists')->willReturn(true);
        $this->useCase = new ResetPeriodUseCase(
            $this->filesystem,
            'path0',
            'path1',
            'path2'
        );
    }

    public function testReset()
    {
        $this->filesystem->expects($this->exactly(1))->method('remove');
        $this->useCase->reset();
    }

}
