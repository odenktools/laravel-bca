<?php

namespace Odenktools\Tests\Bca\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Bca\BcaHttp;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Odenktools\Bca\BcaFactory;
use Odenktools\Bca\BcaManager;
use Odenktools\Tests\Bca\AbstractTestCase;
use Odenktools\Bca\Facades\Bca;

/**
 * BCA service provider test class.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
class FacadeTest extends AbstractTestCase
{
    use FacadeTrait;
   
    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'bca';
    }
    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Bca::class;
    }
    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return BcaManager::class;
    }
}
