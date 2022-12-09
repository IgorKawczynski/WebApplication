# Web Application Project
Repository in the needs of "Projektowanie Aplikacji WWW" subject

<h2> Simple web application based on PHP-HTML-CSS-JS.
  <img src="https://github.com/devicons/devicon/blob/master/icons/php/php-plain.svg" alt="php" width="35" height="35" />
  <img src="https://github.com/devicons/devicon/blob/master/icons/html5/html5-plain-wordmark.svg" alt="html5" width="35" height="35" />
  <img src="https://github.com/devicons/devicon/blob/master/icons/css3/css3-plain-wordmark.svg" alt="css3" width="35" height="35" />
  <img src="https://github.com/devicons/devicon/blob/master/icons/javascript/javascript-plain.svg" alt="js" width="35" height="35" />
</h2>

<p allign="left">

  <br> To properly use the application you must firstly configure and start the Apache and MySQL servers - I recommend do it via XAMPP Control Panel, here is how :
  <br> 1. Download Xampp from : https://www.apachefriends.org/pl/index.html
  <br> 2. Configure your Apache and MySQL servers (MySQL must be running on 3307 port)
  <br> 3. Create MySQL user with 'root' and 'root' credentials (or simply change the passes in config.inc.php in the main folder of app)
  <br> 4. Run your Apache and MySQL server and open your phpMyAdmin on URL : http://localhost/phpmyadmin/
  <br> 5. Create Table `page_list` and insert neccessary records -> use page_list.sql from main folder to import the code into XAMPP phpMyAdmin
  <br> 6. Edit your URL and type : http://localhost/Application/app/ -> Here you have files to browse
  <br> 7. Simply now, you can get to the admin panel via admin folder (URL is http://localhost/Application/app/admin/admin.php) where you have simple CRUD functions to          manage the whole site.
  <br> 8. URL for the main view is : http://localhost/Application/?url=home
</p>

Some views :

Home Page
![image](https://user-images.githubusercontent.com/73948605/206675130-2eb1feaa-52f2-4e54-a036-ea94cb6ac9e0.png)

Admin Panel
![image](https://user-images.githubusercontent.com/73948605/206675287-eec2452e-c7ca-4f57-9bc2-f94291821afb.png)

