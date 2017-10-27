<?php

namespace Odenktools\Tests\Bca;

use Bca\BcaHttp;
use Odenktools\Bca;
use Odenktools\Bca\BcaFactory;

/**
 * BCA factory provider test class.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
class BcaFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getBcaFactory();

        $return = $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key',
            'timezone'      => 'Asia/Jakarta',
            'host'          => 'sandbox.bca.co.id',
            'scheme'        => 'https',
            'development'   => true,
            'options'       => [],
            'port'          => 443,
            'timeout'       => 30,
        ]);
        $this->assertInstanceOf(BcaHttp::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutAuthKey()
    {
        $factory = $this->getBcaFactory();

        $factory->make([
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key',
            'timezone'      => 'Asia/Jakarta',
            'host'          => 'sandbox.bca.co.id',
            'scheme'        => 'https',
            'development'   => true,
            'options'       => [],
            'port'          => 443,
            'timeout'       => 30,
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutAppId()
    {
        $factory = $this->getBcaFactory();

        $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key',
            'timezone'      => 'Asia/Jakarta',
            'host'          => 'sandbox.bca.co.id',
            'scheme'        => 'https',
            'development'   => true,
            'options'       => [],
            'port'          => 443,
            'timeout'       => 30,
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getBcaFactory();

        $factory->make([
            'corp_id'     => 'your-corp_id',
            'client_id'   => 'your-client_id',
            'api_key'     => 'your-api_key',
            'secret_key'  => 'your-secret_key',
            'timezone'    => 'Asia/Jakarta',
            'host'        => 'sandbox.bca.co.id',
            'scheme'      => 'https',
            'development' => true,
            'options'     => [],
            'port'        => 443,
            'timeout'     => 30,
        ]);
    }

    protected function getBcaFactory()
    {
        return new BcaFactory();
    }
}
