<?php

namespace Odenktools\Tests\Bca;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Odenktools\Bca\BcaServiceProvider;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return BcaServiceProvider::class;
    }
}