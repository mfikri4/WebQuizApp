# Laravel 8 - Quiz Application

## Run Locally

Clone the project

```bash
  git clone https://github.com/mfikri4/WebQuizApp.git project-name
```

Go to the project directory

```bash
  cd project-name
```

-   Copy .env.example file to .env and edit database credentials there

lakukan composer install


```bash
    composer install
```

lakukan generate key

```bash
    php artisan key:generate
```

lakukan migrate

```bash
    php artisan migrate
```

#### Login

-   Silahkan Register untuk mendapatkan akses login


#### API SANCTUM

-   API Login
```bash
    http://127.0.0.1:8000/api/login
```

-   API Register
```bash
    http://127.0.0.1:8000/api/register
```

-   API Logout
```bash
    http://127.0.0.1:8000/api/login
```

-   API Get Profile
```bash
    http://127.0.0.1:8000/api/profile
```

-   API Get List User
```bash
    http://127.0.0.1:8000/api/user
```

-   API Get List Question
```bash
    http://127.0.0.1:8000/api/question
```

-   API Get List Result Option
```bash
    http://127.0.0.1:8000/api/result
```

