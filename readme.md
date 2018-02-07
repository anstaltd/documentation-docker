PHP Documentation docker container
==

A docker container that hosts documentation of your working PHP project. Using [sami](https://github.com/FriendsOfPHP/Sami).

## Install

```bash
docker pull ansta/php-documentation:latest
```

```bash
docker run -d 
    -p 80:80 
    -v /sites/mysite/:/var/project 
    -t name=mysites_documentation 
    -e DOCUMENTATION_GITHUB='account/project'
    -e DOCUMENTATION_EXCLUDES='vendor'
```

### Docker compose

```yaml
version: 3

services:

    documentation:
        image: ansta/php-documentation:latest
        name: mysite-documenation
        volumes:
            - ./:/var/project
        ports:
            - 80:80
        args: 
            DOCUMENTATION_GITHUB: account/project
```

## Updating documentation 

```bash
docker exec -it $(docker ps -q) updatedocs
```


## Environment variables 

variable | for | default
--- | --- | ---
DOCUMENTATION_NAME | The file names to include | *.php
DOCUMENTATION_EXCLUDES | The directories to exclude | 
DOCUMENTATION_DIR | Your project's mounting directory | /var/project
DOCUMENTATION_THEME | The sami theme | default
DOCUMENTATION_BUILD_DIR | The output directory | /var/www
DOCUMENTATION_GITHUB | If provided, sami will link to github | 
DOCUMENTATION_OPENED_LEVEL | | 2
