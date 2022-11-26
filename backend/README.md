# Nursery People Backend

## Installation

### Clone and Setup

To ensure your machine is ready for development, make sure that your machine is ready for Laravel development. 

**From the Laravel Docs:**
"Before creating your first Laravel project, you should ensure that your local machine has PHP and Composer installed. If you are developing on macOS (or WSL), PHP and Composer can be installed via Homebrew. In addition, we recommend installing Node and NPM."

#### **Setup Docker**
Follow the appropriate steps to install and configure Laravel with Docker on your machine.
**Docs on setting up Laravel & Docker:**
https://laravel.com/docs/9.x/installation#laravel-and-docker

#### **Windows Users:**

You must use WSL with Docker desktop. Ensure you clone the git repo into your linux filesystem.
https://laravel.com/docs/9.x/installation#getting-started-on-windows

### Clone the Repository 

Ensure you clone the repository into your linux or macOS filesystem.

```bash
git clone https://github.com/cwray-tech/Awia-For-Nurseries.git
```

### Install packages
Open terminal @ Awia-For-Nurseries folder

- [Configure a bash alias for sail](https://laravel.com/docs/9.x/sail#configuring-a-bash-alias) by running the following command in your linux terminal:

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

- Copy sample env `cp .env.example .env`
- Open .env file and update DB setting
- Ensure add a custome database name, username, and password. 
    These can be anything you like as Laravel sail will create the database for you.
- Install composer dependancies:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```


### Start the container:
```bash
sail up -d
```

### Start development:
- Generate App key : `sail artisan key:generate`
- Migrate all tables : `sail artisan migrate`
