* To run the Affiliate Marketing App project<br>
 1- Clone it to your computer.<br>
 2- Run composer install to install application dependencies.<br>
 3- Copy .env.example to .env.<br>
 4- Run php artisan key:generate to generate an application key.<br>
 5- Add database credentials to .env.<br>
 6- Run php artisan migrate to migrate the database.<br>
 7- Run php artisan user:create to create admin user.<br>
  <br>
* we have 4 main pages<br>
1- Login Page<br>
2- Register Page<br>
3- User Dashboard<br>
4- Admin Dashboard<br>
  <br>
* I've used a role system using two middleware<br>
 1- AdminAuthenticated<br>
 2- UserAuthenticated<br>
  <br>
* I've created the table called visitors to stored visitors for the register page & we are used CountVisitor Middleware to stored data.<br>
* we have three conditions for store visitors:<br>
  1- the visitor visits the registration page using the referrer link.<br>
  2- the request has a GET Method<br>
  3- the IP address allow to store one time<br>
  <br>
* I've built admin users using the command: php artisan user:create<br>
  <br>
* I've used charts to see the number of registered users within 14 days<br>
  <br>
* I've created a referrer id (foreign key) column inside the users table to know who's shared his referrer link for the user<br>
  <br>
* I've generated a referrer token using email md5 hash & stored the hash inside referrer token column inside users table<br>
  <br>
* I've generated the referrer link inside the User model using the getReferralLinkAttribute() function<br>
  <br>
* I've upload image inside register page inside public/upload folder<br>
