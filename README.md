denkmal.org [![Build Status](https://travis-ci.org/denkmal/denkmal.org.png)](https://travis-ci.org/denkmal/denkmal.org)
===========

Dev Installation
----------------
Apache:
```conf
<VirtualHost *:80>
  ServerName denkmal.dev
  RedirectPermanent / http://www.denkmal.dev/
</VirtualHost>

<VirtualHost *:80>
  ServerName www.denkmal.dev
  ServerAlias admin.denkmal.dev
  DocumentRoot /Users/reto/Projects/denkmal.org

  <Directory /Users/reto/Projects/denkmal.org/>
    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ public/$1
  </Directory>

  <Directory /Users/reto/Projects/denkmal.org/public/>
    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php
    RewriteRule .* - [E=HTTP_X_REQUESTED_WITH:%{HTTP:X-Requested-With}]
  </Directory>
</VirtualHost>
```
