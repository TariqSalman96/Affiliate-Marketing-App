* To run the Affiliate Marketing App project
 1- Clone it to your computer.
 2- Run composer install to install application dependencies.
 3- Copy .env.example to .env.
 4- Run php artisan key:generate to generate an application key.
 5- Add database credentials to .env.
 6- Run php artisan migrate to migrate the database.
 7- Run php artisan user:create to create admin user.

* we have 4 main pages
1- Login Page
2- Register Page
3- User Dashboard
4- Admin Dashboard

* I've used a role system using two middleware
 1- AdminAuthenticated
 2- UserAuthenticated

* I've created the table called visitors to stored visitors for the register page & we are used CountVisitor Middleware to stored data.
* we have three conditions for store visitors:
  1- the visitor visits the registration page using the referrer link.
  2- the request has a GET Method
  3- the IP address allow to store one time

* I've built admin users using the command: php artisan user:create

* I've used charts to see the number of registered users within 14 days

* I've created a referrer id (foreign key) column inside the users table to know who's shared his referrer link for the user

* I've generated a referrer token using email md5 hash & stored the hash inside referrer token column inside users table

* I've generated the referrer link inside the User model using the getReferralLinkAttribute() function

* I've upload image inside register page inside public/upload folder
