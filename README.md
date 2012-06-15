CCDNComponent DashboardBundle README.
=====================================


## Notes:  
  
This bundle is for the symfony framework and requires Symfony 2.0.x and PHP 5.3.6
  
This project uses Doctrine 2.0.x and so does not require any specific database.
  

This file is part of the CCDNComponent bundles(s)

(c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 

Available on github <http://www.github.com/codeconsortium/>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.

Icons courtesy of http://pc.de/icons/ licensed under http://creativecommons.org/licenses/by/3.0/
Theme and Sprite graphics courtesy of [twitter bootstrap](http://twitter.github.com/bootstrap/index.html) and [GLYPHICONS](http://glyphicons.com/).

Other graphics are works of CodeConsortium.

## Description.

This is a Symfony2 bundle for creating a Dashboard for site navigation. It features a plug and play service architecture. 

Bundles can register services via tags to list their links within the dashboard bundle. Because it uses service tags, bundles 
are not coupled with the Dashboard and if Dashboard bundle is removed, then nothing will break. 

Each link can be specified in any given bundles DashboardIntegrator class which you can place in the bundles Component/Dashboard folder.

The class can contain numerous links, each with a specified route or a statically typed url. An icon and translated text.

## Features.

DashboardBundle Provides the following features:

1. Bundles Integrate via service tags.
2. Decoupled interaction with 3rd party bundles.
3. Bundles can add multiple links from a single class.
4. Links can be grouped into categories which are shared by more than one bundle.
5. Each link can specify either a route or a url.
6. Each link can specify a graphical icon to use.
7. Each link has access to the SF2 translator to translate prior to rendering.

Before installation of this bundle, you can download the [Sandbox](https://github.com/codeconsortium/CCDNSandBox) for testing/development and feature review, or alternatively see the product in use at [CodeConsortium](http://www.codeconsortium.com).

## Documentation.

Documentation can be found in the `Resources/doc/index.md` file in this bundle:

[Read the Documentation](index.md).

## Installation.

All the installation instructions are located in [documentation](install.md).

## License.

This software is licensed under the MIT license. See the complete license file in the bundle:

	Resources/meta/LICENSE

[Read the License](http://github.com/codeconsortium/DashboardBundle/blob/master/Resources/meta/LICENSE).

## About.

[CCDNComponent DashboardBundle](http://github.com/codeconsortium/DashboardBundle) is free software from [Code Consortium](http://www.codeconsortium.com). 
See also the list of [contributors](http://github.com/codeconsortium/DashboardBundle/contributors).

## Reporting an issue or feature request.

Issues and feature requests are tracked in the [Github issue tracker](http://github.com/codeconsortium/DashboardBundle/issues).

Discussions and debates on the project can be further discussed at [Code Consortium](http://www.codeconsortium.com).
