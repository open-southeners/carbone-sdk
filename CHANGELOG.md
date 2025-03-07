# Change Log

All notable changes to the "laravel-pint" extension will be documented in this file.

Check [Keep a Changelog](http://keepachangelog.com/) for recommendations on how to structure this file.

## [Unreleased]

## [2.0.0] - 2025-03-07

### Removed

- PHP 8.1 support (adding support to Laravel 12)
- `template()->exists()` method as endpoint doesn't accept `HEAD` anymore

## [1.2.0] - 2024-03-21

### Added

- Methods `getFileName`, `getFileExtension` & `getFileMimeType` methods on the template download response
- Laravel 11 support

## [1.1.1] - 2024-01-17

### Fixed

- ServiceProvider not registering carbone properly on Laravel apps

## [1.1.0] - 2024-01-05

### Changed

- Now render endpoint gets response object with `getRenderId()` method

## [1.0.0] - 2023-12-26

### Added

- Initial release!
