<?php

namespace Odenktools\Tests\Bca;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Odenktools\Bca\BcaServiceProvider;

/**
 * BCA unit test class.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass()
    {
        return BcaServiceProvider::class;
    }
}
