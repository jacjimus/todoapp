
## Requirements for the app to run

The app requires the following extensions in order to work properly:

- `PHP = 8.1`
- `MySql 8.1`
- `BCMath`
- `Ctype`
- `JSON`
- `Mbstring`
- `OpenSSL`
- `PDO`
- `Tokenizer`
- `Composer`


## Installation

Follow the steps below to install and run the application locally.

```
Clone the repo from GitHub: 
git clone git@github.com:jacjimus/todoapp.git todoapp
 
```

```
 cd todoapp
```
Credentials for authentication after migration

Install dependencies:

```bash
composer install
```
```bash
npm install
```

```bash
npm run build
```

Generate app key:

```bash
php artisan key:generate
```

Run database migrations and seeds:

```bash
php artisan migrate --seed
```


```
You can register your own account :)
```


Run unit and feature tests:

```bash
composer test
```

code style checker level 8

```bash
composer analyse
```
Build  Docker containers:

```bash
docker-compose build app
```

Start all  Docker containers:

```bash
docker-compose  up  -d
```

``` API endpoint - Get user token
POST Request: {app_url}/api/token : params email: your_email_address, password: your_password
```

``` API endpoint - Get user tasks
GET Request:  {app_url}/api/user/tasks : Authentication Bearer token (received from the above request)
```


``` Assumptions made
Users can only view, edit and delete their own tasks, Hence the application is using Model policy to authorize those actions
```
