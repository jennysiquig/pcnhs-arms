WAMP Server configuration setup
[phpconf]
Options Indexes FollowSymLinks MultiViews
    AllowOverride all
        Order Deny,Allow
        Allow from all

[httpconf]
<Directory>
AllowOverride none
    Require all granted
<Directory/>
<Directory...>
Options FollowSymLinks
    AllowOverride None
    Order deny,allow
    Allow from all
Order Deny,Allow
	Allow from all
	Allow from 127.0.0.1
<Directory/>