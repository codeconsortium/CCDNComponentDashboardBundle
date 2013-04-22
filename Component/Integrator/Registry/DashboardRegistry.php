<?php

/*
 * This file is part of the CCDNComponent DashboardBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNComponent\DashboardBundle\Component\Integrator\Registry;

/**
 *
 * @category CCDNComponent
 * @package  DashboardBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNComponentDashboardBundle
 *
 */
class DashboardRegistry
{
    /**
     *
      * @access protected
     */
    protected $integratorChain;

    /**
     *
     * @access protected
     * @var \CCDNComponent\DashboardBundle\Component\Integrator\Model\Builder
     */
    protected $builder;

    /**
     *
     * @access protected
     * @var bool $built
     */
    protected $built;

    /**
     *
     * @access public
       * @param $container
     */
    public function __construct($integratorChain, $builder)
    {
        $this->integratorChain = $integratorChain;

        $this->builder = $builder;

        $this->built = false;
    }

    /**
     *
     * @access public
     */
    public function build()
    {
        if (false == $this->built) {
            $subscribers = $this->integratorChain->getIntegrators();

            foreach ($subscribers as $subscriberkey => $subscriber) {
                $subscriber->build($this->builder);
            }

            $this->built = true;
        }
    }

    /**
     *
     * @access public
     * @return \CCDNComponent\DashboardBundle\Component\Integrator\Model\Builder
     */
    public function getBuilder()
    {
        $this->build();

        return $this->builder;
    }

    /**
     *
     * @access public
     * @return array
     */
    public function getPages()
    {
        $this->build();

        return $this->builder->getPages();
    }

    /**
     *
     * @access public
     * @param $category
     * @return array
     */
    public function getCategoriesForPage($page)
    {
        $this->build();

        return $this->builder->getCategoriesForPage($page);
    }

    /**
     *
     * @access public
      * @return array
     */
    public function getCategories()
    {
        $this->build();

        return $this->builder->getCategories();
    }
}
