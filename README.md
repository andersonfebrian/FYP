<h3>Software Prerequisites</h3>
<ol>
    <li> XAMPP (includes PHP, Apache, MySQL) - https://www.apachefriends.org/download.html </li>
    <li> Composer - https://getcomposer.org/download/ </li>
    <li> Node/NPM - https://nodejs.org/en/download/ </li>
    <li> Git - https://git-scm.com/downloads </li>
</ol>

<h3>Setup Project Locally</h3>

1. Clone Project to local machine (Preferably to <em>xampp/htdocs</em> folder) - `git clone `  
2. Install Dependencies - `composer install` and `npm install` and `npm run dev`
3. Create <em>.env</em> file - `cp .env.example .env`  
    3.1  
    3.2
4. `php artisan key:generate`  
5. `php artisan storage:link`
6. `php artisan migrate`  

<h3>Local Deployment</h3>  

1. locate <em>hosts</em> file located under `C:\Windows\System32\drivers\etc\` and add the following: `127.0.0.1 fyp.test`  


Notes:

Accessing web cam on browser requires https, as such in xampp, find makecert batch file under apache folder and run it. Can leave everything blank except Common Name (this should be the url for the application).

After that, navigate to conf folder, open httpd.conf, find line that contains "LoadModule rewrite_module modules/mod_rewrite.so", if its commented, uncomment it.

In the same file, add the following to the end of file:

```
RewriteEngine On 
RewriteCond %{HTTPS} off 
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}
```

back on the conf folder, navigate to the extra folder and open httpd-xampp.conf and add the following to the end of file:

```
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Redirect /xampp folder to https
    RewriteCond %{HTTPS} !=on
    RewriteCond %{REQUEST_URI} xampp
    RewriteRule ^(.*) https://%{SERVER_NAME}$1 [R,L]

    # Redirect /phpMyAdmin folder to https
    RewriteCond %{HTTPS} !=on
    RewriteCond %{REQUEST_URI} phpmyadmin
    RewriteRule ^(.*) https://%{SERVER_NAME}$1 [R,L]

    # Redirect /security folder to https
    RewriteCond %{HTTPS} !=on
    RewriteCond %{REQUEST_URI} security
    RewriteRule ^(.*) https://%{SERVER_NAME}$1 [R,L]

    # Redirect /webalizer folder to https
    RewriteCond %{HTTPS} !=on
    RewriteCond %{REQUEST_URI} webalizer
    RewriteRule ^(.*) https://%{SERVER_NAME}$1 [R,L]

    # Redirect /folder_name folder to https
    RewriteCond %{HTTPS} !=on
    RewriteCond %{REQUEST_URI} folder_name
    RewriteRule ^(.*) https://%{SERVER_NAME}$1 [R,L]

</IfModule>
```

in the same file, add `SSLRequireSSL` to the `<Directory>` which you want SSL enabled.

after that, open httpd-vhost.conf file under the same folder and add the following configuration:

```
<VirtualHost fyp.test:443>
	ServerAdmin localhost
	DocumentRoot "C:/xampp/htdocs/biosecure_fyp/public"
	ServerName fyp.test
	<Directory "C:/xampp/htdocs/biosecure_fyp/public">
		Order allow,deny
		Allow from all
	</Directory>
	
	SSLEngine on
	SSLCertificateFile "conf/ssl.crt/server.crt"        | Note: this is the cert that is created using the makecert file, usually will be kept in the conf/ssl.crt folder
	SSLCertificateKeyFile "conf/ssl.key/server.key"     | for this it will be located under the conf/ssl.key folder
</VirtualHost>
```

if virtual host is pointing to port 80, just change to 443.

done, restart apache and the application will be served under ssl/https. (althouth not secured, its still ok for local development for WebRTC APIs)
