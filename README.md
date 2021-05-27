
this project contains two parts

1- web applicaion
2- Restful API 

using:

- laravel 8 
- passport for authentication 
- swagger for api documentaion 
- mysql for datebase


1. Clone the repository 
	https://github.com/wassimassi/products_catalog.git
	
	or download the code
	
2. open the project using visual studio code


3. Install all the dependencies using composer

	composer install
	
4. copy the content of .env.example file to .env
	
5. create a datebase using mysql with the same name and confiquration in .env file
	
	DB_DATABASE=productcatalog
	DB_USERNAME=root
	DB_PASSWORD=

6. run command: php artisan passport:install

7. run command: php artisan migrate
	
8. run command: php artisan l5-swagger:generate

8. run command: php artisan serve

visit http://127.0.0.1:8000/categories for website
visit http://127.0.0.1:8000/api/documentation for API documentation



