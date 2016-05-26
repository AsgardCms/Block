# Block Module

[![Latest Version](https://img.shields.io/github/release/asgardcms/block.svg?style=flat-square)](https://github.com/asgardcms/block/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Sblock](https://img.shields.io/scrutinizer/g/asgardcms/block.svg?style=flat-square)](https://scrutinizer-ci.com/g/asgardcms/block)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/650c6d28-e888-4bbc-a57b-cf684d3fe7bf.svg)](https://insight.sensiolabs.com/projects/650c6d28-e888-4bbc-a57b-cf684d3fe7bf)
[![CodeClimate](https://img.shields.io/codeclimate/github/AsgardCms/Block.svg)](https://codeclimate.com/github/AsgardCms/Block)

[![Total Downloads](https://img.shields.io/packagist/dd/asgardcms/block.svg?style=flat-square)](https://packagist.org/packages/asgardcms/block)
[![Total Downloads](https://img.shields.io/packagist/dm/asgardcms/block.svg?style=flat-square)](https://packagist.org/packages/asgardcms/block)
[![Total Downloads](https://img.shields.io/packagist/dt/asgardcms/block.svg?style=flat-square)](https://packagist.org/packages/asgardcms/block)
[![Slack](http://slack.asgardcms.com/badge.svg)](http://slack.asgardcms.com/)


| Branch | Travis-ci |
| ---------------- | --------------- |
| master  | [![Build Status](https://travis-ci.org/AsgardCms/Block.svg?branch=master)](https://travis-ci.org/AsgardCms/Block)  |

## Installation

You can install the Block module with composer:

```sh
$ composer require asgardcms/block
```

Then run the following command to install the database tables:

```sh
$ php artisan module:migrate Block
```

In the backend GUI, go to Users > Roles > Admin. Then the permissions tab, and give the Admin role the permissions for the block module.

## Documentation

This is a very simple module to create re-usable blocks of content. The blocks of content are created in the administration. You give it a name and a content.

After this, you'll be able to get the content of a block with the following code:

``` php
{!! Block::get('block-name') !!}
```

## Resources

- [Contribute to AsgardCMS](https://asgardcms.com/en/docs/getting-started/contributing)
- [License](LICENSE.md)


## Info

All AsgardCMS modules respect [Semantic Versioning](http://semver.org/).
