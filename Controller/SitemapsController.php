<?php

App::uses('SitemapsAppController', 'Sitemaps.Controller');

/**
 * Sitemaps Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.5
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class SitemapsController extends SitemapsAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Sitemaps';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array(
		'Setting',
		'Node',
	);

/**
 * index
 *
 * @return void
 */
	public function index() {
		$conditions = array(
			'Node.status' => 1,
		);
		$types = array_keys(Configure::read('Sitemaps.types'));
		if ($types != array('*')) {
			$conditions['Node.type'] = $types;
		}
		$nodes = $this->Node->find('all', array(
			'conditions' => $conditions,
			'fields' => array(
				'id',
				'title',
				'slug',
				'type',
				'updated',
			),
			'recursive' => -1,
		));

		$output  = '<?xml version="1.0"?>';
		$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach ($nodes as $node) {
			$output .= '<url>';
				$settings = Configure::read('Sitemaps.types.' . $node['Node']['type']);
				if (!$settings) {
					$settings = Configure::read('Sitemaps.types.*');
				}

				$url = Router::url(array(
					'plugin' => 'nodes',
					'controller' => 'nodes',
					'action' => 'view',
					'type' => $node['Node']['type'],
					'slug' => $node['Node']['slug'],
				), true);
				$output .= '<loc>' . $url . '</loc>';
				$output .= '<lastmod>' . date('Y-m-d', strtotime($node['Node']['updated'])) . '</lastmod>';
				$output .= '<changefreq>' . $settings['changefreq'] . '</changefreq>';
			$output .= '</url>';
		}
		$output .= '</urlset>';

		header('Content-type: text/xml; charset=utf-8');
		echo $output;

		exit;
	}

}
