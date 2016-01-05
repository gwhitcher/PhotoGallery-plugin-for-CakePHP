# PhotoGallery plugin for CakePHP

Developed by: [George Whitcher](http://georgewhitcher.com)

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

* The recommended way to install composer packages is: composer require gwhitcher/cakephp-photo-gallery (If composer is unavailable download the zip and extract it to your plugins directory.)

* PhotoGallery requires Imagick php extension for image resizing: [Imagick](http://php.net/manual/en/imagick.setup.php).  You cannot run it without it.

* Install the database tables by visiting DOMAIN.com/photo_gallery/install or by running the below queries on your database.

CREATE TABLE gallery (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id INT(11),
    title VARCHAR(50),
    description TEXT,
    img VARCHAR(50),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

CREATE TABLE category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    description TEXT,
    img VARCHAR(50),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

* CHMOD 777 your /plugins/PhotoGallery/webroot/img/gallery and all it's subfolders.

* Go to your /ROOT/config/bootstrap.php and load the plugin by adding the following to the end of the file: Plugin::load('PhotoGallery', ['bootstrap' => false, 'routes' => true]);

* Congratulations you are all setup!


## URL Structure (this can be changed in routes.php)

The URL's are as follows:
Auto Installer:
DOMAIN.com/photo_gallery/install

Main gallery view:
DOMAIN.com/photo_gallery/gallery
DOMAIN.com/photo_gallery/category

Gallery image add:
DOMAIN.com/photo_gallery/gallery/add

Category add:
DOMAIN.com/photo_gallery/category/add

Gallery image edit: (replace ID)
DOMAIN.com/photo_gallery/gallery/edit/ID

Category edit: (replace ID)
DOMAIN.com/photo_gallery/category/edit/ID

Gallery image delete: (replace ID)
DOMAIN.com/photo_gallery/gallery/delete/ID

Category delete: (replace ID)
DOMAIN.com/photo_gallery/category/delete/ID


## CUSTOM SECURITY

Open /plugins/PhotoGallery/src/Controller/AppController.php

You will see some commented out code.  Remove the comments so it will be functioning.

Get your IP and replace it with the 127.0.0.1 (If you remove the comments from echo $ip you can get your current IP.  It will show at the top of any unsecured page. Just make sure to remove it after you have noted your IP.)