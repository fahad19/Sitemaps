<?php
$output = '<?xml version="1.0"?>';
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