# Mini REST API
This is a basic front controller redirect all requests on `web/index.php` for example with `php -S localhost web/index.php`
1. Sorry for all the `DIRECTORY_SEPARATOR`. I code it on windows :shame: but with them it will be portable   
2. You will find a postman collection in `Deezer.postman_collection.json` file to see all possible url for the API  
3. You will find DB model in `data/dataFixture.php`, as you will see I used *SQLITE* instead of *MySQL* and I apologize for that :shame:  
4. All source code will be in src folder under the namespace Deezer  
For the record I made it in aproximately 9 hours of work  
5. For exercise 2 see `/front` and enjoy my lovely taste for video game music  (You must listen to furi sondtrack it is godlike)
6. To go further:
 * use a proper PSR4 `Logger` And PSR7 `Request` and `Response`
 * Enhance Commands with prepared Queries i don't know why i didn't do it in the first place
 * Pass `Request` Object To controller to avoid `$_GET` in `Proxy` class
 7. I pass aproximately 9-10 Hours of work on this.