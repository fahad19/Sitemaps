# Sitemaps

Sitemaps plugin for Croogo.

Follows the protocol found at: http://www.sitemaps.org/protocol.html

## Requirements

Croogo v1.5 or higher.

## Installation

Clone/Upload the content of this repository to /app/Plugin/Sitemaps, and activate the plugin from your admin panel.

## Usage

Visit /sitemaps.xml or /sitemaps from your browser.

If /sitemaps.xml does not work, ensure that your /Config/routes.php file has

```php
Router::parseExtensions();
Router::setExtensions(array('json', 'rss'));
```

Instead of

```php
Router::parseExtensions('json', 'rss');
```