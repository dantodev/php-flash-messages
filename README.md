[![Latest Stable Version](https://poser.pugx.org/dtkahl/php-flash-messages/v/stable)](https://packagist.org/packages/dtkahl/php-flash-messages)
[![License](https://poser.pugx.org/dtkahl/php-flash-messages/license)](https://packagist.org/packages/dtkahl/php-flash-messagesK)
[![Build Status](https://travis-ci.org/dtkahl/php-flash-messages.svg?branch=master)](https://travis-ci.org/dtkahl/php-flash-messages)

# PHP flash messages

Session flash messages for PHP


## Dependencies

* `PHP >= 5.6.0`


## Installation

Install with [Composer](http://getcomposer.org):

    composer require dtkahl/php-flash-messages


## Usage

```php
session_start();
$flash = new \Dtkahl\FlashMessages\FlashMessages;
```

**Warning:* Every new instance  will be handled as new call and trunked data under given key in given store.


## Methods

#### get($type, $key, $default = null)

Returns message with given `$type` and `$key` from last call or `$default` if there is no message.

**or call with predefined type:**
- getError($key, $default = null)
- getWarning($key, $default = null)
- getSuccess($key, $default = null)
- getInfo($key, $default = null)


#### has($type, $key)

Determinate if there is any message with given `$type` and `$key` from last call.

**or call with predefined type:**
- hasError($key)
- hasWarning($key)
- hasSuccess($key)
- hasInfo($key)


#### set($type, $key, $value)

Save message with given `$type` and `$key` to store for next call.

**or call with predefined type:**
- setError($key, $value)
- setWarning($key, $value)
- setSuccess($key, $value)
- setInfo($key, $value)


#### remove($type, $key)

Remove message with given `$type` and `$key` from store for next call.

**or call with predefined type:**
- removeError($key)
- removeWarning($key)
- removeSuccess($key)
- removeInfo($key)


#### getAll($type)

Return an array of all messages with given `$type` from last call.

**or call with predefined type:**
- getAllError()
- getAllWarning()
- getAllSuccess()
- getAllInfo()

#### getAllTypes()

Return an array of all types and their messages from last call.

*TBA:* hasAny(), hasAny{type}()
