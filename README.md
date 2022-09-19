# DrupalCon Europe 2022 Demo Repository
This repository contains the code that was used in [the presentation "Building a GraphQL API -
Beyond the Basics" by Alexander Varwijk](https://www.alexandervarwijk.com/talks/2022-09-21-building-a-graphql-api-beyond-the-basics),
given at DrupalCon Europe 2022 in Prague.

The git history follows the flow of the presentation and describes what has happened in each step.

# Installation

## Docker

The commands below assume a newer version of Docker for Desktop on Mac and Windows, or the
installation of the compose plugin v2 on Linux. If you're running an older version you may need
to replace `docker compose` with `docker-compose`.

### Install in Docker containers ###

1. Copy and rename the `.env.dist` to `.env` and update the .env variables, if you don't want to use the defaults. We recommend to use the `.localhost` domain extension for the `PROJECT_BASE_URL`; so that you don't have to update your host file.

```bash
cp .env.dist .env
```

2Run the nginx-proxy container, you only need one even if you have multiple projects.
```
docker compose --file docker-compose.nginx.yml --project-name nginx up --detach
```

3. Run the docker containers for the project:
```
docker compose up --detach
```

4. Depending on the configured `PROJECT_BASE_URL`, you can access the following services:
- Drupal: http://drupalcon.localhost
- Mailcatcher: http://mailcatcher.drupalcon.localhost

## Installing git in our container
The Drupal docker image doesn't come with git, but we do need it to install some of our testing
requirements.

```bash
docker exec -ti drupalcon_web apt-get update
docker exec -ti drupalcon_web apt-get install -y git
```

## Composer Requirements
This project uses composer to manage its dependencies. Install the packages by running:

```bash
docker exec -ti drupalcon_web composer install
```
