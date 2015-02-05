# phpsession

By [Joe Fallon](http://blog.joefallon.net)

This library has the following features:

*   Fully unit tested.
*   Does not keep the session open between reads and writes. This allows AJAX requests
    to not be [blocked](http://konrness.com/php5/how-to-prevent-blocking-php-requests/).
*   Simple to use. Can be fuller understood in a matter of minutes.
*   Allows a maximum age to be used for session invalidation.
*   Allows a maximum inactivity time to be used for session invalidation.

## Installation

The easiest way to install PHP Scalars is with
[Composer](https://getcomposer.org/). Create the following `composer.json` file
and run the `php composer.phar install` command to install it.

```json
{
    "require": {
        "joefallon/phpsession": "*"
    }
}
```

## Usage

```php
$foo     = 'bar';
$session = new Session();
$session->write($foo, 'value');
$session->read($foo);   // value
```

The `Session` class contains the following methods:

```
__construct($maxAgeInSecs = 1800, $lastActivityTimeoutInSecs = 1800)
read($key)
write($key, $val)
unsetSessionValue($key)
maxAgeTimeoutExpired()
lastActivityTimeoutExpired()
destroy()
```
