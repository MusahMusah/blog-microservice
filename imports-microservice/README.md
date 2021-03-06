# About
This is a microservice that will be used to perform posts import from [here](https://sq1-api-test.herokuapp.com/posts) upon job event triggered from Post Microservice. It is also
connected to a docker network that will be used to connect to the User Microservice.

## Responsibilities
* Create a new Import by Admin User
* Communicate with User Microservice to get the user information
* Communicate with Post Microservice to send import whose next_execution_date is less than current date

## Directories and Files to Be Aware of:
* `/app/Console/Commands/AutoImportPost.php` - The command that will be used to trigger the job.
* `/app/Http/` - The controllers, middleware, requests and resources will be used from this directory.
* `/app/Jobs/` - The jobs will be used from this directory.
* `/app/Models/` - The models will be used from this directory.
* `/app/Services/` - The services which extracts the business logic.
* `/app/Traits/` - The traits will be used from this directory.
* `/app/routes/api.php` - The routes will be used from this file.

## Api Endpoints
The application is built with RESTful API endpoints. No frontend is built due to the simplicity of the application and time constraints.

### The Login Endpoint
![img_1.png](img_1.png)

### Logout Endpoint
![img_2.png](img_2.png)

### Create Import Endpoint
![img_3.png](img_3.png)

