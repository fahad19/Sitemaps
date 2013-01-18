<?php

//Router::parseExtensions('xml');

CroogoRouter::connect('/sitemaps.xml', array(
	'plugin' => 'sitemaps',
	'controller' => 'sitemaps',
	'action' => 'index',
));
