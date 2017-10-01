<?php

namespace Odenktools\Bca;

use Bca\BcaHttp;
use InvalidArgumentException;

/**
 * Laravel BCA REST API Library.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
class BcaFactory
{
    /**
     * Create a new BcaHttp client.
     *
     * @param array $config
     *
     * @return \BcaHttp
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = [
            'corp_id',
            'client_id',
            'client_secret',
            'api_key',
            'secret_key',
            'scheme',
            'port',
            'timezone',
            'host',
            'timeout',
            'development',
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, $keys);
    }

    /**
     * Get the bca http.
     *
     * @param string[] $auth
     *
     * @return \BcaHttp
     */
    protected function getClient(array $auth)
    {
        return new BcaHttp(
            $auth['corp_id'],
            $auth['client_id'],
            $auth['client_secret'],
            $auth['api_key'],
            $auth['secret_key']
        );
    }
}
