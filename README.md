# Task - CGRD 


### Installation guide

1. Start Containers:

First, you need to make sure your Docker containers are up and running. If you’re using docker-compose, you can start them with:
```bash
docker-compose up -d
```

2. Install Composer

After the containers are up and running, you need to install Composer inside the container 
You can do this by running the following command, where {NAME} is the name of your container (replace {NAME} with your actual container name or ID):```bash
```bash
docker exec -it {NAME} composer install
```

3. Create Tables and Start Data:

After installing the Composer dependencies, run the migration script to create the required database tables and start the initial data setup:
```bash
docker exec -it {NAME} php /var/www/migration_run.php
```

### Login details
Login: admin

Password: test