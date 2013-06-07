# denkmal.org

## Dev Installation
### Apache

```conf
<VirtualHost *:80>
  ServerName denkmal.local
  RedirectPermanent / http://www.denkmal.local/
</VirtualHost>

<VirtualHost *:80>
  ServerName www.denkmal.local
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
