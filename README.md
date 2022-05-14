# About The Microservice
This blog platform microservice was built with PHP/Laravel, it allows users to register, login and create blog posts.
Admin User can import posts from other blogs by providing the blog's REST API URL, and the frequency of import.
Cron job / scheduler runs every minute to import posts from other blogs.

This project is designed as a microservice, each microservice is a separate Laravel application running on docker.
<img width="1265" alt="image" src="https://user-images.githubusercontent.com/51837314/168129363-5c458e06-604d-4766-aa5d-feb8464654ed.png">


Task details can be accessed [here](https://www.notion.so/Web-Developer-0cdf0bb1015d4e5c94b62b3fe61ee621).

## Technologies used
- Server application:
    - [Laravel](https://laravel.com/), A PHP web framework with focus on speed of development and perfectionism
    - [Docker](https://www.docker.com/), A set of platform as a service products that use OS-level virtualization to deliver software in packages called containers.
    - [Redis](https://redis.io/), in-memory data store which can be used as a database, cache, streaming engine, and message broker.
    - [RabbitMQ](https://www.rabbitmq.com/), a message broker and messaging system.
    - [Postman](https://www.getpostman.com/), a complete API development environment, and flexibly integrates with the software development cycle for API testing.

## Installation
### Local installation
Running this service locally requires you to download and install docker and docker-compose. You can do this by downloading
docker desktop from [here](https://www.docker.com/products/docker-desktop) and follow the instructions to install docker.
- Installation with docker
    - Download docker desktop from [here](https://www.docker.com/products/docker-desktop)
    - Install docker

- Basic installation with docker for `individual service`:
    - Ensure Git is installed on your machine, then clone this repository by running `git clone https://github.com/MusahMusah/blog-microservice.git` in the terminal.
    - Enter the directory with `cd name-of-service`
    - Create a `.env` file using the [.env.example](/.env.example) file as a template. All the appropriate values has been filled in the `.env.example`, but you can change the values to suit your environment if all the credentials in `docker-compose.yml` file are set.
    - Run `docker-compose up -d` to start the application. You can now access the application at `http://localhost:8001`.
    - Run `docker exec -it name-of-service sh` to enter the container (for bash replace `sh` with `bash`).
    - Run `php artisan migrate --seed` to seed the database with default admin user access.
    - Run `cat routes/api.php` to see the routes available.

### Docker
If you've got Docker installed, edit the `.docker-compose.yml` file to your taste (you wouldn't need to except you hate me), then run `docker-compose build` and `docker-compose up -d` to spin up the server.

The application should be running, via the following URL;
### Imports Microservice
https://localhost:8083
### Posts Microservice
https://localhost:8082
### Users Microservice
https://localhost:8081

## API Enpoints documentation
The application is built with RESTful API endpoints. No frontend is built due to the simplicity of the application and time constraints.


## Testing 🚨
- No automation Testing is available.
- Get the application up and running by following the instructions in the Installation Guide of this README.

## Discussion
* The Reason for using microservices software architecture is to have a loosely coupled system.
This means that the system can be decoupled from the other components, making the system scalable and easy to maintain.
* The Post Microservice handles importing posts from external blogs via a REST API as well as creating and retrieving posts.
Post import is done via a cron job, which runs every minute validating posts to be imported from their next_export_time and frequency as specified in the database.
This way posts can be imported from multiple blogs automatically.

Another approach to importing posts from external blogs is to have an individual cron job for each import. This way the cron job can be scheduled to run based on the frequency of import.
This was not implemented in this project due to time constraints.

### Improvements for a production API
- Write tests with attention to non-framework specific features.

## Licence 🔐
[MIT licensed](/LICENSE) © [Musah Musah](https://github.com/MusahMusah)

## Credits 🙏
- Half of the Open Source Software community who contribute to the whole of the tools I use
- Others who would be thanked by my smiles and Quora tags
