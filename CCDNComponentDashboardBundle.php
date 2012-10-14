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

namespace CCDNComponent\DashboardBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use CCDNComponent\DashboardBundle\DependencyInjection\Compiler\IntegratorCompilerPass;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class CCDNComponentDashboardBundle extends Bundle
{

    /**
     *
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new IntegratorCompilerPass());
    }

	/**
	 *
	 * @access public
	 */
	public function boot()
	{
		$twig = $this->container->get('twig');	
		$twig->addGlobal('ccdn_component_dashboard', array(
			'seo' => array(
				'title_length' => $this->container->getParameter('ccdn_component_dashboard.seo.title_length'),
			),
			'dashboard' => array(
				'show' => array(
					'layout_template' => $this->container->getParameter('ccdn_component_dashboard.dashboard.show.layout_template'),
				),
			),
		));
	}
	
}
