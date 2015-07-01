# Block Module


| Branch | Travis-ci |
| ---------------- | --------------- |
| master  | [![Build Status](https://travis-ci.org/AsgardCms/Block.svg?branch=master)](https://travis-ci.org/AsgardCms/Block)  |
| develop  | [![Build Status](https://travis-ci.org/AsgardCms/Block.svg?branch=develop)](https://travis-ci.org/AsgardCms/Block)   |

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/AsgardCms/Block/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/AsgardCms/Block/?branch=master)

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
