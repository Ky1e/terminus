<?php

namespace Terminus\UnitTests;

use Terminus\Dispatcher;
use Terminus\Dispatcher\RootCommand;

/**
 * Testing class for Terminus\Dispatcher
 */
class DispatcherTest extends TerminusTest
{

    public function testGetPath()
    {
        $root_command = new RootCommand();
        $path = Dispatcher\getPath($root_command);
        $this->assertEquals($path, ['terminus']);
    }
}
