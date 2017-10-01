<?php

namespace Odenktools\Bca;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * Laravel BCA REST API Library.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
class BcaManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Odenktools\Bca\BcaFactory
     */
    private $factory;

    /**
     * Create a new Bca manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Odenktools\Bca\BcaFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, BcaFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'bca';
    }

    /**
     * Get the factory instance.
     *
     * @return \Odenktools\Bca\BcaFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
