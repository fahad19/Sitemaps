<?php
$output = '<ul class="sitemap">';
foreach ($nodes as $node) {
	$output .= '<li>';
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
	$output .= $this->Html->link($node['Node']['title'], $url);
	$output .= '</li>';
}
$output .= '</ul>';

echo $output;