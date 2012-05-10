CCDNComponent DashboardBundle README.
=====================================


Notes:  
------
  
This bundle is for the symfony framework and thusly requires Symfony 2.0.x and PHP 5.3.6
  
This project uses Doctrine 2.0.x and so does not require any specific database.
  

This file is part of the CCDNComponent bundles(s)

(c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 

Available on github <http://www.github.com/codeconsortium/>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.

Icons courtesy of http://pc.de/icons/ licensed under http://creativecommons.org/licenses/by/3.0/

Other graphics are works of CodeConsortium.

Dependencies:
-------------

1. [CCDNComponent CommonBundle](https://github.com/codeconsortium/CommonBundle).
2. [CCDNComponent CrumbTrailBundle](https://github.com/codeconsortium/CrumbTrailBundle).


Installation:
-------------

1) Download and install the dependencies.

   You can set deps to include:

```sh
[CCDNComponentCommonBundle]
    git=http://github.com/codeconsortium/CommonBundle.git
    target=/bundles/CCDNComponent/CommonBundle

[CCDNComponentCrumbTrailBundle]
    git=http://github.com/codeconsortium/CrumbTrailBundle.git
    target=/bundles/CCDNComponent/CrumbTrailBundle

[CCDNComponentDashboardBundle]
	git=http://github.com/codeconsortium/DashboardBundle.git
	target=/bundles/CCDNComponent/DashboardBundle
```

add to your autoload:

```php
    'CCDNComponent'    => __DIR__.'/../vendor/bundles',
```

2) In your AppKernel.php add the following bundles to the registerBundles method array:  

```php
    new CCDNComponent\DashboardBundle\CCDNComponentDashboardBundle(),    
``` 

3) In your app/config/routing.yml add:  

```php
CCDNComponentDashboardBundle:
    resource: "@CCDNComponentDashboardBundle/Resources/config/routing.yml"
    prefix: /
 
```

4) Symlink assets to your public web directory by running this in the command line:

```php
    php app/console assets:install --symlink web/
```

Making your applications plug and playable with Dashboard is easy, first add to your own bundle the following service definition:

```yml
acme_pizza_admin.dashboard.integrator.class: Acme\PizzaAdminBundle\Component\Dashboard\DashboardIntegrator


acme_pizza_admin.dashboard.integrator:
    class: %acme_pizza_admin.dashboard.integrator.class%
    arguments: [@service_container]
    tags:
        - { name: ccdn_component_dashboard.integrator }
```

Then add a directory structure of Component\Dashboard and create a file DashboardIntegrator.php and put the following contents in the file:

```php
/*
 * This file is part of the CCDNComponent DashboardBundle as an example!
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 
 * 
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNAcme\AcmePizzaBundle\Component\Dashboard;

use CCDNComponent\DashboardBundle\Component\Integrator\BaseIntegrator;

/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class DashboardIntegrator extends BaseIntegrator
{

	
	
	/**
	 *
	 *
	 * Structure of $resources
	 * 	[DASHBOARD_PAGE String]
	 * 		[CATEGORY_NAME String]
	 *			[ROUTE_FOR_LINK String]
	 *				[AUTH String]
	 *				[URL_LINK String]
	 *				[URL_NAME String]
	 */
	public function getResources()
	{
		$resources = array(
			'admin' => array(
				'Administrate Pizza Ingredients' => array(
					'admin_pizza_edit' => array('auth' => 'ROLE_ADMIN', 'name' => 'Edit Ingredients Choices', 'icon' => $this->basePath . '/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_category.png'),
				),
			),

		);
		
		return $resources;
	}
	
}
```

The array is where you store data relevant to that particular bundle, the first level of indices in the array can be used to specify what pages items will appear on.

The array key as demonstrated in the above example (labelled in the legend as ROUTE_FOR_LINK) should be the name of the route that your link should go to. If however you cannot provide the route name because of some route properties you can specify a url as a param.

For example, /en/dashboard/admin will show all items added to the admin index. Of course if you just type in /en/dashboard then everything would appear.

You can repeat this step as many times as necessary in each individual bundle, and /en/dashboard will bring them all together into one nice integrated panel for easy navigation across your site.

The service tag ccdn_component_dashboard.subscriber is what notifies the dashboard of the links in your bundles DashboardIntegrator.php file.

You can also use the same page index across multiple bundles and when you view the page they will be grouped together. 

See the other codeconsortium bundles such as the Forum bundle for more examples of this.


Then your done, if you need further help/support, have suggestions or want to contribute please join the community at [www.codeconsortium.com](http://www.codeconsortium.com)
