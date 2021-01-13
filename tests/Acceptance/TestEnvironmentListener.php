<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Acceptance;

use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;

class TestEnvironmentListener implements TestListener
{
    use TestListenerDefaultImplementation;

    public function startTestSuite(TestSuite $suite): void
    {
        if ('default' === $suite->getName() || 'acceptance' === $suite->getName()) {
            TestEnvironmentFacade::start();
        }
    }
}