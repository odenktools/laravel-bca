<?php

namespace Odenktools\Tests\Bca;

use Bca\BcaHttp;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Odenktools\Bca;
use Odenktools\Bca\BcaFactory;
use Odenktools\Bca\BcaManager;

/**
 * BCA manager test class.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
class BcaManagerTest extends AbstractTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('bca.default')->andReturn('bca');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(BcaHttp::class, $return);

        $this->assertArrayHasKey('bca', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);

        $factory = Mockery::mock(BcaFactory::class);

        $manager = new BcaManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('bca.connections')->andReturn(['bca' => $config]);

        $config['name'] = 'bca';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(BcaHttp::class));

        return $manager;
    }
}
