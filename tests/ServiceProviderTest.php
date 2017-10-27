<?php

namespace Odenktools\Tests\Bca;

use Bca\BcaHttp;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Odenktools\Bca\BcaFactory;
use Odenktools\Bca\BcaManager;

/**
 * BCA service provider test class.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testPusherFactoryIsInjectable()
    {
        $this->assertIsInjectable(BcaFactory::class);
    }

    public function testPusherManagerIsInjectable()
    {
        $this->assertIsInjectable(BcaManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(BcaHttp::class);
        $original = $this->app['bca.connection'];
        $this->app['bca']->reconnect();
        $new = $this->app['bca.connection'];
        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
