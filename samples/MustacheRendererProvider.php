<?php
/**
 * Part of the Joomla Framework Renderer Package
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    http://www.gnu.org/licenses/lgpl-2.1.txt GNU Lesser General Public License Version 2.1 or Later
 */

namespace Joomla\Renderer\Service;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Renderer\MustacheRenderer;

/**
 * Mustache renderer service provider
 *
 * @since  1.0
 */
class MustacheRendererProvider implements ServiceProviderInterface
{
	/**
	 * Configuration instance
	 *
	 * @var    array
	 * @since  1.0
	 */
	private $config;

	/**
	 * Constructor.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	public function __construct(array $config = array())
	{
		$this->config = $config;
	}

	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function register(Container $container)
	{
		$options = $this->config;

		$container->set(
			'Joomla\Renderer\RendererInterface',
			function (Container $container) use ($options) {
				/* @type  \Joomla\Registry\Registry  $config */
				$config = $container->get('config');

				$loaderOptions = array('extension' => $config->get('template.extension'));

				$params = array(
					'loader'          => new \Mustache_Loader_FilesystemLoader($config->get('template.path'), $loaderOptions),
					'partials_loader' => new \Mustache_Loader_FilesystemLoader($config->get('template.partials'), $loaderOptions),
				);

				$options = array_merge($params, $options);

				return new MustacheRenderer($options);
			},
			true,
			true
		);

		$container->alias('renderer', 'Joomla\Renderer\RendererInterface');

		return;
	}
}
