
# Sqauere1 Blog 
*this the name i chosed for this exercise*

## problem statement 
Implementation of a blogging platform(Text only) where people can signIn/Login, add  new posts with their accounts, view posts, sort posts by publication date. guess(Not registered users) can come and view posts and sort by publication date also. The platform is expected to handle high traffic. It expected that the platform collects some posts from a feed server which is also receiving high traffic. 

## Implemetation Overview 
### back-end
The performance issue related to the feed server is handled by the implementation of a PHP artisan command with is ran just once in the lifetime of the application.
The role of the command is to collect the desired posts from the ResT end-point and add them to the application's database. 

Performance issues related to high traffic on the application are handled by using Laravel caching system. The application relies heavily on caching. The only thing which is not cached in search results. The application relies on Laravel Observer to update its cache. It listens to changes (created_at, updateed_at) on the post model and triggers a refresh of the cache. 

I have added a search functionality that enables the user to search for posts by title, content/description and, user_name at the same time. This is very handy if you want to know the posts create by users having a particular name and to also filter the posts by any of those fields. It should be noted that the search is performed efficiently and with performance using eloquent query builder.  

The application is SEO optimized and benchmarked using google lighhouse.

### front-end
The front-end is built heavily with tailwindcss and vuejs, blade for SEO pages, and SASS to write raw styles.
It's built with a mobile-first design in mind. It's SPA. 
navigation is mainly handled using vue-router. 

## Prerequisits
### PHP8: 
The project runs on laravel 8.12 and this version of laravel works only with php8 

### composer.phar or composer2.0 

## Running project 
Assuming that we are a linux environment.  

```git clone https://github.com/gilons/square1-blog.git```  

``` cd square1-blog```   


``` composer install ```  


``` npm install ```  

 **create a .env from the .env.example file and add in your database credentials**
 

``` php artisan key:generate```

 
```php artisan migrate ``` 


``` php artisan posts:init ``` 


``` composer dump-autoload ``` 


``` php artisan optimize ``` 


``` npm run dev ``` 


``` php artisan serve ```
