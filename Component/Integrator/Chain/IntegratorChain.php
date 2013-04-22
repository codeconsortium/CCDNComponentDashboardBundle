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

namespace CCDNComponent\DashboardBundle\Component\Integrator\Chain;

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
class IntegratorChain
{
    /**
     *
     * @access private
     */
    private $integrators;

    /**
     *
     * @access public
     */
    public function __construct()
    {
        $this->integrators = array();
    }

    /**
     *
      * @access public
     * @param IntegratorInterface $integrator
     */
    public function addIntegrator($integrator)
    {
        $this->integrators[] = $integrator;
    }

    /**
     *
      * @access public
     * @return array $integrators
     */
    public function getIntegrators()
    {
        return $this->integrators;
    }
}
