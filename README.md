# Docker for Property Display WordPress

This project contains Docker configuration for running an old WordPress site (2018-2019) in a local environment with SSL support.

## Requirements

- Docker
- Docker Compose

## Project Structure

- `Dockerfile` - Configuration for creating a WordPress image with PHP 7.2
- `docker-compose.yml` - Configuration for running WordPress and MySQL containers
- `update-domain.sh` - Script for updating the domain in the database

## Running the Project

1. Clone the repository and navigate to the project directory:

```bash
cd project-directory
```

2. Start the containers:

```bash
docker-compose up -d
```

3. The site will be available at: https://propertydisplayed.co.uk

4. Add the following entry to your hosts file to access the site locally:

```
127.0.0.1 propertydisplayed.co.uk
```

## Changing the Domain

If you need to change the site domain, use the `update-domain.sh` script:

```bash
chmod +x update-domain.sh
./update-domain.sh old_domain new_domain
```

Example:
```bash
./update-domain.sh propertydisplayed.co.uk your-domain.com
```

## Production Setup

For use in a production environment:

1. Change database credentials in `docker-compose.yml`
2. Update the domain using the `update-domain.sh` script
3. Configure Traefik for SSL termination (as specified in the requirements)

## Notes

- Uses PHP 7.2, which was current for WordPress 2018-2019
- Database is imported from the `db740303479_200311.sql` file
- WordPress files are taken from the `propdisp/propdisp_wp` directory
- Self-signed SSL certificate is used for local development
- Standard ports 80 (HTTP) and 443 (HTTPS) are used
