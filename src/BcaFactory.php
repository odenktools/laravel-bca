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
     * @param array $options optional parameter
     *
     * @return BcaHttp
     */
    public function make(array $config, array $options = [])
    {
        $config = $this->getConfig($config);

        return $this->getClient($config, $options);
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
            'secret_key'
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_intersect_key($config, array_flip((array)$keys));
    }

    /**
     * Get the BCA Http client.
     *
     * @param string[] $auth
     * @param array $options optional parameter
     *
     * @return BcaHttp
     */
    protected function getClient(array $auth, array $options = [])
    {
        return new BcaHttp(
            $auth['corp_id'],
            $auth['client_id'],
            $auth['client_secret'],
            $auth['api_key'],
            $auth['secret_key'],
            $options
        );
    }
}
