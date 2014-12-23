# CoffeeScript PHP

A port of the [CoffeeScript](http://jashkenas.github.com/coffee-script/)
compiler to PHP.

## Status

CoffeeScript version **1.3.1** has been fully ported over (see
[tags](http://github.com/alxlit/coffeescript-php/tags)). There are a couple
benign differences between the port's compiled code and the reference's (for
example [#11](https://github.com/alxlit/coffeescript-php/issues/11)), otherwise
they match 100%.

## Requirements

PHP 5.3+ (uses namespaces, anonymous functions).

## Install

It's recommended that you use [Composer](http://getcomposer.org) to install
and autoload CoffeeScript. Alternatively you can load it manually:

```php
<?php

require 'vendor/CoffeeScript/Init.php';

// Load manually
CoffeeScript\Init::load();

?>
```

## Usage

The API is really basic (single `compile($coffee, $options = NULL)` function).
I don't plan on expanding it further (keeping it simple). Here are the available
options:

  * **filename** - The source filename, formatted into error messages
  * **header** - Add a "Generated by..." header
  * **rewrite** - Enable the rewriter (debugging)
  * **tokens** - Reference to token stream (debugging)
  * **trace** - File to write parser trace to (debugging)

```php
<?php

$file = 'path/to/source.coffee';

try
{
  $coffee = file_get_contents($file);

  // See available options above.
  $js = CoffeeScript\Compiler::compile($coffee, array('filename' => $file));
}
catch (Exception $e)
{
  echo $e->getMessage();
}

?>
```

## Development

To rebuild the parser run `php make.php`. Tests are run in the browser; simply
clone the repository somewhere Apache can see it and navigate to tests/.

## FAQ

#### What was the motivation for this project?

I was using PHP a lot at the time and wanted to use, learn more about, and
potentially contribute to the CoffeeScript project. I thought it'd be nice to
have a native version gave it a shot.

#### Why not modify the original compiler to emit PHP?

For a number of reasons... First, I don't know why you'd want something like
that. If you find PHP intolerable, just don't use it... Second, the original
compiler depends on Jison, which is written in JavaScript, so you'd have to do
something about that. Third, I think it'd be much more work to try and sort out
all the differences between JavaScript and PHP (object model, core classes
and libraries, etc).

#### What parser generator are you using?

Since there's no PHP port of Bison (which the reference compiler uses), we're
using a port of Lemon called [ParserGenerator](http://pear.php.net/package/PHP_ParserGenerator).

It's included locally since the PEAR package is unmaintained and seems to be
broken. In addition, some minor changes have been made to the parser template 
(Lempar.php) and the actual generator.
