# Bonnier Publications Coding Challenge
This repository contains a [Docker compose](https://docs.docker.com/compose/), [Laravel](https://laravel.com/docs/7.x) and [VueJS](https://vuejs.org/) starter application, which doesn't quite work.

There are specified tasks below, which needs to be solved to complete this coding challenge.

1. Don't fork the repository, please download or clone the source code instead.
2. Create a Github public repository and push your solution to the repository master or main branch.
3. Send the repository URL to us. 

## Project description
Bob is a freelancer that wants to keep track of how much time he spends working on different projects.
At any given time, he is working on different projects, giving each of them a unique name.
He needs to be able to log the date, the time he starts, and the time he stops working on a project, so that he knows how much time in total he has spent on it.
He needs to be able to start and stop the same project multiple times.
For a GUI, Bob does not need much, but he must be able to see an overview of the time spent on his projects, create new projects, and add entries to existing ones.

## Tasks:
Complete functionalities to support with following requirements:
1. Can add, edit, delete and view details of projects.
2. Can start and stop entry on a project multiple times. 
3. Calculate total time (with date format hh:mm:ss) spent on a project and display it in the project overview.
4. Make the page automatically update after updated projects and stop entries without reload the page.
5. Optional: You are welcome to add features/functions relevant to the project.

## Quick start:
We have set up the basic developing environment for the project with docker compose. 
You can follow the steps to begin the coding challenge.

1. [Install Docker Compose](https://docs.docker.com/compose/install/)
2. Execute the following commands:
```
> docker-compose up -d
> docker-compose exec app composer install
> docker-compose exec app php artisan key:generate
> docker-compose exec app php artisan migrate --seed
```
3. All containers should be running:
```
> docker-compose ps
```
4. App is running on: http://localhost:8000/home
5. Login with test user as defined in .env:
```
email: test@example.com
password: secret
```
