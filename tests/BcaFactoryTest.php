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

        $options = array();

        $return = $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key'
        ], $options);

        $this->assertInstanceOf(BcaHttp::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientSecret()
    {
        $factory = $this->getBcaFactory();
        
        $options = array();
        
        $factory->make([
            'client_id'     => 'your-client_id',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key'
        ], $options);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecretKey()
    {
        $factory = $this->getBcaFactory();
        
        $options = array();
        
        $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key'
        ], $options);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientId()
    {
        $factory = $this->getBcaFactory();

        $options = array();

        $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key'
        ], $options);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutCorpId()
    {
        $factory = $this->getBcaFactory();

        $options = array();

        $return = $factory->make([
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key'
        ], $options);
    }

    public function testMakeBindClientSecret()
    {
        $factory = $this->getBcaFactory();

        $new = $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'xxxxxxxxxxxxxxx',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key',
        ]);

        $settings = $new->getSettings();

        $equal     = 'xxxxxxxxxxxxxxx';
        
        $this->assertEquals($equal, $settings['client_secret']);
    }

    public function testMakeBindPort()
    {
        $factory = $this->getBcaFactory();

        $options = [
           'port'        => 4413,
        ];

        $new = $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key'
        ], $options);

        $settings = $new->getSettings();

        $equal     = 4413;
        
        $this->assertEquals($equal, $settings['port']);
    }

    public function testMakeBindHost()
    {
        $factory = $this->getBcaFactory();

        $options = [
           'host'        => 'hello.bca.co.id',
        ];

        $new = $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'xxxxxxxxxxxxxxx',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key'
        ], $options);

        $settings = $new->getSettings();

        $equal     = 'hello.bca.co.id';

        $this->assertEquals($equal, $settings['host']);
    }
    
    public function testMakePassHost()
    {
        $factory = $this->getBcaFactory();

        $new = $factory->make([
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'xxxxxxxxxxxxxxx',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key'
        ]);

        $settings = $new->getSettings();

        $equal     = 'sandbox.bca.co.id';
        
        $this->assertEquals($equal, $settings['host']);
    }
    
    public function testTimeZone()
    {
        $factory = $this->getBcaFactory();

        $options = [
           'timezone'    => 'Asia/Jakarta',
           'host'        => 'sandbox.bca.co.id',
           'scheme'      => 'https',
           'development' => true,
           'port'        => 443,
           'timeout'     => 30,
        ];

        $bca = $factory->make([
            'corp_id'     => 'your-corp_id',
            'client_id'   => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'     => 'your-api_key',
            'secret_key'  => 'your-secret_key'
        ], $options);

        $bca::setTimeZone('Asia/Singapore');

        $timezone = $bca::getTimeZone();

        $this->assertNotSame(
            $timezone,
            'Asia/Singapoe'
        );
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getBcaFactory();

        $options = [
           'timezone'    => 'Asia/Jakarta',
           'host'        => 'sandbox.bca.co.id',
           'scheme'      => 'https',
           'development' => true,
           'port'        => 443,
           'timeout'     => 30,
        ];

        $factory->make([
            'corp_id'     => 'your-corp_id',
            'client_id'   => 'your-client_id',
            'api_key'     => 'your-api_key',
            'secret_key'  => 'your-secret_key'
        ], $options);
    }
    
    public function testFund()
    {
        $factory = $this->getBcaFactory();

        $options = [
           'timezone'    => 'Asia/Jakarta',
           'host'        => 'sandbox.bca.co.id',
           'scheme'      => 'https',
           'development' => true,
           'port'        => 443,
           'timeout'     => 30,
        ];

        $bca = $factory->make([
            'corp_id'     => 'your-corp_id',
            'client_id'   => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'     => 'your-api_key',
            'secret_key'  => 'your-secret_key'
        ], $options);

        $token = "o7d8qCgfsHwRneFGTHdQsFcS5Obmd26O10iBFRi50Ve8Yb06Ju5xx";

        $response = $bca->fundTransfers(
            $token,
            '50000.00',
            '0201245680',
            '0201245681',
            '12345/PO/2017',
            'Testing Saja Ko',
            'Online Saja Ko',
            '00000001'
        );

        $this->assertEquals($response->code, 400);
    }

    public function testGenerateSign()
    {
        $factory = $this->getBcaFactory();

        $options = [
           'timezone'    => 'Asia/Jakarta',
           'host'        => 'sandbox.bca.co.id',
           'scheme'      => 'https',
           'development' => true,
           'port'        => 443,
           'timeout'     => 30,
        ];

        $bca = $factory->make([
            'corp_id'     => 'your-corp_id',
            'client_id'   => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'     => 'your-api_key',
            'secret_key'  => 'your-secret_key'
        ], $options);

        $token          = "NopUsBuSbT3eNrQTfcEZN2aAL52JT1SlRgoL1MIslsX5gGIgv4YUf";
        $arrayAccNumber = array('0063001004');
        $arraySplit     = implode(",", $arrayAccNumber);
        $uriSign        = "GET:/banking/v2/corporates/corpid/accounts/$arraySplit";
        $isoTime        = "2017-09-30T22:03:35.800+07:00";

        $authSignature  = $bca::generateSign($uriSign, $token, "9db65b91-01ff-46ec-9274-3f234b677450", $isoTime, null);

        $output = "761eaec0e544c9cf5010b406ade39228ab182401e57f17fc54b9daa5ad99d0d6";

        $this->assertEquals($authSignature, $output);
    }
    
    protected function getBcaFactory()
    {
        return new BcaFactory();
    }
}
