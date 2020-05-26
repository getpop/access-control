# Access Control

[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Software License][ico-license]](LICENSE.md)

<!--
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Total Downloads][ico-downloads]][link-downloads]
-->

Access Control for fields and directives

## Install

Via Composer

``` bash
composer require getpop/access-control
```

## Usage

Initialize the component:

``` php
\PoP\Root\ComponentLoader::initializeComponents([
    \PoP\AccessControl\Component::class,
]);
```

## How does it work?

Access control deals in 2 modes: Public/Private schema modes.

The difference between Public and Private schema modes concerns the feedback given to the user when a validation fails. In Public mode, a detailed error message is given to the user (eg: "only users with role 'administrator' can access this field). In Private mode, there is no helpful information, instead the user is told that the field or directive does not exist.

We need to implement 4 cases of access control:

1. Fields in Public schema mode
2. Directives in Public schema mode
3. Fields in Private schema mode
4. Directives in Private schema mode

In Public schema mode, we can simply add a special directive that will validate the restriction (such as: is the user logged in? does the logged-in user have a specific role or capability?).

In Private mode, we add a hook that filters out the field or directive before it is registered.

In addition, whenever a validation must be performed to know if the user can access a field or directive, the response from the GraphQL server cannot be cached (when using component [Cache Control](https://github.com/getpop/cache-control)). For the Public mode this situation is automatically handled, since the directive validating if the user is logged in or not already indicates that the response cannot be cached. For the Private mode, however, we need to add a special directive `"NoCache"`. Hence, we need to deal with the following 2 cases:

1. `NoCache` for Fields in Private schema mode
2. `NoCache` for Directives in Private schema mode

## Standards

[PSR-1](https://www.php-fig.org/psr/psr-1), [PSR-4](https://www.php-fig.org/psr/psr-4) and [PSR-12](https://www.php-fig.org/psr/psr-12).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
composer test
```

## Static Analysis

Execute [phpstan](https://github.com/phpstan/phpstan) with level 5:

``` bash
composer analyse
```

To run checks for level 0 (or any level from 0 to 8):

``` bash
./vendor/bin/phpstan analyse -l 0 src tests
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email leo@getpop.org instead of using the issue tracker.

## Credits

- [Leonardo Losoviz][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/getpop/access-control.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/getpop/access-control/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/getpop/access-control.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/getpop/access-control.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/getpop/access-control.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/getpop/access-control
[link-travis]: https://travis-ci.org/getpop/access-control
[link-scrutinizer]: https://scrutinizer-ci.com/g/getpop/access-control/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/getpop/access-control
[link-downloads]: https://packagist.org/packages/getpop/access-control
[link-author]: https://github.com/leoloso
[link-contributors]: ../../contributors
