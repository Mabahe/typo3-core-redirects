# TYPO3 v9 Redirects in v8.7

This is a composer package to integrate the redirects from version 9 into version 8.7.

[![Redirects](https://img.youtube.com/vi/hln_FGFD_WY/0.jpg)](https://www.youtube.com/watch?v=hln_FGFD_WY)

Since this feature needs some other patches for the core, the composer patches packages is used to the patch the core on `composer install`. 

## Installation

After running `composer require mabahe/typo3-core-redirects` the patching will fail, because the package will
be installed after `typo3/cms`.

To fix this run `composer install`.
