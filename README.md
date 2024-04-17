![WP Devhelper Logo](resources/images/helper-repo-logo.png "WP Devhelper")

[![License: LGPL v3](https://img.shields.io/badge/License-LGPL%20v3-blue.svg)](https://www.gnu.org/licenses/lgpl-3.0)

# WP Devhelper

_WP Devhelper_ is a library of functions that theme and plug-in developers can use
to provide a consistent experience to their users, by abstracting as much of the standard WordPress
functionality, hooks and settings as possible - resulting in a much simpler and less time-consuming 
way to develop with WordPress (current WordPress target version is _4.9.2_).

_WP Devhelper_ helps developers to stop worrying about WordPress-specific implementation 
details and gotchas - and to get on with the business of building something awesome!

_WP Devhelper_ can function as:            

* an included PHP library (as part of a theme or plug-in that is installed),
* or as an installed plug-in itself (which can conveniently be updated via WordPress' update mechanism).

## Features

* Front-end WordPress API method and hook wrappers
* Back-end WordPress API method and hook wrappers (including rapid UI development)
* Supports MVC or the MVVMC methodologies
* Database and file logging; along with log viewer (if back-end tools UI is enabled)
* WordPress options editor (if back-end tools UI is enabled)
* WP_DEBUG indicator (in the back-end)

## Getting Started

###As an included library, with Composer:

Make sure Composer is installed - if not, you can get it from [here](https://getcomposer.org/ "getcomposer.org").

First, you need to add _WP Devhelper_ as a dependency in your _composer.json_ file.

To use the current stable version, add the following to download it straight from [here](https://packagist.org/ "packagist.org"):

__PLEASE NOTE!__ There is currently no stable version available, WP Devhelper is still under development until version 1.0.0 - this is here for future reference (currently use "ion/wp-devhelper": "dev-default" instead)

```
"require": {
    "php": ">=7.0",
    "ion/wp-devhelper": "^1.*",
}
```

To use the bleeding edge (development) version, add the following:

```
"require": {
    "php": ">=7.1",
    "ion/wp-devhelper": "dev-default",	
},
"repositories": {
    {
      "type": "vcs",
      "url": "https://bitbucket.org/wpsolved/wp-devhelper/"
    }
}
```

Then run the following in the root directory of your project:

> php composer.phar install



###As a WordPress plugin (using [wordpress.org](https://wordpress.org/ "wordpress.org")):

__PLEASE NOTE!__ There is currently no stable version available, WP Devhelper is still under development until version 1.0.0 - this is here for future reference.

Simply log into your WordPress installation, navigate to:

> _Plugins_ > _Add new_

Then search for '_WP Devhelper_' and install as you would any other plugin.

###As a WordPress plugin (using manual upload):

Download a packaged version (in __.ZIP__ format), [here](https://bitbucket.org/wpsolved/wp-devhelper/downloads/?tab=tags "bitbucket.org")

Log into your WordPress installation and navigate to:

> _Plugins_ > _Add new_ > Upload Plugin

Then select the __.ZIP__ and upload.

###As an included library, without Composer:

Download a packaged version (in __.ZIP__ format), [here](https://bitbucket.org/wpsolved/wp-devhelper/downloads/?tab=tags "bitbucket.org")

Unzip the package and make sure you include '_include.php_,' like so (assuming you unzipped the package into the relative path '_includes/wp-devhelper_'):

```
require_once( __DIR__ . '/includes/wp-devhelper/include.php' ); 
```


### Prerequisites

* WordPress
* Composer (_optional_)


## Built With

* [Composer](https://getcomposer.org/) - Dependency Management
* [Phing](https://www.phing.info) - Used to generate custom builds for various target PHP versions (5.6, 7.0, 7.1)
* [NetBeans](https://www.netbeans.org) - IDE
* [PHP Storm](https://www.jetbrains.com/phpstorm/) - IDE

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://bitbucket.org/wpsolved/wp-devhelper/downloads/?tab=tags "bitbucket.org"). 

## Authors

* **Justus Meyer** - *Initial work* - [BitBucket](https://bitbucket.org/justusmeyer)

## License

This project is licensed under the LGPL-3.0 License - see the [LICENSE.md](LICENSE.md) file for details.

