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

	public $components = array(
		'RequestHandler'
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

		$this->set('nodes', $nodes);
	}

}
