<?php
CroogoRouter::connect('/sitemaps', array(
	'plugin' => 'sitemaps',
	'controller' => 'sitemaps',
	'action' => 'index'
));
Router::setExtensions(['xml']);