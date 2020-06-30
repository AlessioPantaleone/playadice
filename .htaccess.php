<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} !on
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule . /playadice/index.php [L]


</IfModule>