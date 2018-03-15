# TYPO3 v9 Redirects in v8.7

This is a composer package to integrate the redirects from version 9 into version 8.7.

[![Redirects](https://img.youtube.com/vi/hln_FGFD_WY/0.jpg)](https://www.youtube.com/watch?v=hln_FGFD_WY)

Since this feature needs some other patches for the core, the composer patches packages is used to patch the core on `composer install`. 

## Installation

Read (https://github.com/cweagans/composer-patches#user-content-allowing-patches-to-be-applied-from-dependencies) to allow
patches to be applied from dependencies, if you don't already use composer patches.

After running `composer require mabahe/typo3-core-redirects` the patching will fail, because the package will
be installed after `typo3/cms`.

To fix this run `composer install`.

## On top

Additionally this package contains a patch to be able to set all domains of a site root dynamically using a placeholder as domain. This will hopefully be available in version 9 soon, too.

## Migrate

From realurl redirects https://gist.github.com/Mabahe/99a92f9b25878cfec3af9f400bde6568.js
