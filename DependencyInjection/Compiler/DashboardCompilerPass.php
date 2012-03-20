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

namespace CCDNComponent\DashboardBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;


/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class DashboardCompilerPass implements CompilerPassInterface
{
	
	
	
	/**
	 *
	 *
	 */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('ccdn_component_dashboard.subscriber_chain')) {
            return;
        }

        $definition = $container->getDefinition('ccdn_component_dashboard.subscriber_chain');

        foreach ($container->findTaggedServiceIds('ccdn_component_dashboard.registry') as $id => $attributes) {
            $definition->addMethodCall('addSubscriber', array(new Reference($id)));
        }
    }
}