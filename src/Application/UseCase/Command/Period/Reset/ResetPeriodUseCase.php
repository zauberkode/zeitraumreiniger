<?php

namespace App\Application\UseCase\Command\Period\Reset;

use Symfony\Component\Filesystem\Filesystem;

class ResetPeriodUseCase
{
    public function __construct(
        private Filesystem $filesystem,
        private string $pathToKey,
        private string $pathToOther,
        private string $pathToUserPrefs
    ) {
        if (!$this->pathToKey || !$filesystem->exists($this->pathToKey)) {
            throw new \Exception('File with the path to the key does not exist');
        }
        if (!$this->pathToOther || !$filesystem->exists($this->pathToOther)) {
            throw new \Exception('File with the path to the other does not exist');
        }
        if (!$this->pathToUserPrefs ||!$filesystem->exists($this->pathToUserPrefs)) {
            throw new \Exception('File with the path to the user prefs does not exist');
        }
    }

    public function reset()
    {
        $this->filesystem->remove([
            $this->pathToKey,
            $this->pathToOther,
            $this->pathToUserPrefs,
        ]);
    }

}
