<?php
/**
 * Renderer Package
 *
 * @copyright  Copyright (C) 2014 Michael Babker. All rights reserved.
 * @license    http://www.gnu.org/licenses/lgpl-2.1.txt GNU Lesser General Public License Version 2.1 or Later
 */

namespace BabDev\Renderer;

use League\Plates\Template;
use League\Plates\Engine;

/**
 * Plates class for rendering output.
 *
 * @since  1.0
 */
class PlatesRenderer extends Template implements RendererInterface
{
	/**
	 * Rendering engine
	 *
	 * @var    Engine
	 * @since  1.0
	 */
	private $engine;

	/**
	 * Configuration array
	 *
	 * @var    array
	 * @since  1.0
	 */
	private $config;

	/**
	 * Data for output by the renderer
	 *
	 * @var    array
	 * @since  1.0
	 */
	private $data = array();

	/**
	 * A constructor method
	 *
	 * @param   array  $config  Configurations
	 *
	 * @since   1.0
	 */
	public function __construct($config = array())
	{
		$this->config = $config;
		$this->engine = new Engine;
	}

	/**
	 * Render and return compiled data.
	 *
	 * @param   string  $template  The template file name
	 * @param   array   $data      The data to pass to the template
	 *
	 * @return  string  Compiled data
	 *
	 * @since   1.0
	 */
	public function render($template, array $data = array())
	{
		$data = array_merge($this->data, $data);

		// TODO Process template name

		parent::render($template, $data);
	}

	/**
	 * Add a folder with alias to the renderer
	 *
	 * @param   string  $alias      The folder alias
	 * @param   string  $directory  The folder path
	 *
	 * @return  boolean  True if the folder is loaded
	 *
	 * @since   1.0
	 */
	public function addFolder($alias, $directory)
	{
		$this->engine->addFolder($alias, $directory);
	}

	/**
	 * Sets file extension for template loader
	 *
	 * @param   string  $extension  Template files extension
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function setFileExtension($extension)
	{
		$this->engine->setFileExtension($extension);
	}

	/**
	 * Checks if folder, folder alias, template or template path exists
	 *
	 * @param   string  $path  Full path or part of a path
	 *
	 * @return  boolean  TRUE of the path exists
	 *
	 * @since   1.0
	 */
	public function pathExists($path)
	{
		// TODO check for directories
		return $this->engine->exists($path);
	}

	/**
	 * Loads data from array into the renderer
	 *
	 * @param   array  $data  Array of variables
	 *
	 * @return  boolean  True if data loaded successfully
	 *
	 * @since   1.0
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

	/**
	 * Unloads data from renderer
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function unsetData()
	{
		$this->data = array();
	}

	/**
	 * Sets a piece of data
	 *
	 * @param   string  $key    Name of variable
	 * @param   string  $value  Value of variable
	 *
	 * @return  RendererInterface  Returns self for chaining
	 *
	 * @since   1.0
	 */
	public function set($key, $value)
	{
		// TODO Make use of Joomla\Registry to provide paths
		$this->data[$key] = $value;
	}
}