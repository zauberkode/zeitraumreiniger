<?php

namespace App\Tests\Infrastructure\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CleanCommandTest extends KernelTestCase
{
    private Application $application;

    private $testFileKeyHandler;
    private $testFileOtherHandler;
    private $testFileUserPrefsHandler;

    public function setUp(): void
    {
        $projectDir = $_SERVER['PWD'];
        $testVarDir = $projectDir . '/var/tests';

        $testFileKeyPath = $testVarDir . '/testKey.txt';
        $testFileOtherPath = $testVarDir . '/testOther.txt';
        $testFileUserPrefsPath = $testVarDir . '/testUserPrefs.txt';

        $this->testFileKeyHandler = fopen($testFileKeyPath, 'w');
        $this->testFileOtherHandler = fopen($testFileOtherPath, 'w');
        $this->testFileUserPrefsHandler = fopen($testFileUserPrefsPath, 'w');

        $_ENV['PATH_TO_KEY'] = $testFileKeyPath;
        $_ENV['PATH_TO_OTHER'] = $testFileOtherPath;
        $_ENV['PATH_TO_USERPREFS'] = $testFileUserPrefsPath;

        $kernel = self::bootKernel();
        $this->application = new Application($kernel);
    }

    public function tearDown(): void
    {
        fclose($this->testFileKeyHandler);
        fclose($this->testFileOtherHandler);
        fclose($this->testFileUserPrefsHandler);
    }

    public function testExecute(): void
    {
        $command = $this->application->find("app:clean");
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $commandTester->assertCommandIsSuccessful();
    }

}
