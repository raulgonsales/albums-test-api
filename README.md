## Basic overview

The application is developed with api-platform framework (https://api-platform.com/).

After running `install.sh` script, the full application will be ready and prepared to receive API requests.

The database will have 3 users prepared (passwords are hashed with `bcrypt`, so do not change it in database directly):
    
1. Basic user that has a `ROLE_LOGGED_USER`. This user is a user that has
 all rights to work with the API (create album, get albums, etc...)

    **username**: `amateri.user`, **password**: `amateri_password`

2. Same as `amateri.user` but with different password.

   **username**: `test.user`, **password**: `test_password`

3. Vendor user with role `ROLE_VENDOR_USER`. This user can be logged in into the 
application but cannot access `/api/*` resource

   **username**: `vendor.user`, **password**: `vendor_password`

In addition to users, the database has also `album` and `image` tables. These tables have random faked data prepared.

PostgreSQL credential:
```json
host: localhost
user: app
DB: app
Password: !ChangeMe!
```

## Requirements

`Docker`

## Install

Better to restart `Docker` before.

1. Run ``docker compose build --no-cache``. This will build all needed containers. Wait until it is finished.
2. Run ``docker compose up --pull --wait ``. This will run containers and run migrations.
Wait until you see:
    ```
    albums-test-api-php-1       | Waiting for database to be ready...
    albums-test-api-php-1       | The database is now ready and reachable
    albums-test-api-php-1       | [notice] Migrating up to DoctrineMigrations\Version20231024193304
    albums-test-api-php-1       | [notice] finished in 37.8ms, used 24M memory, 8 migrations executed, 32 sql queries
    albums-test-api-php-1       | 
    albums-test-api-php-1       |  [OK] Successfully migrated to version :                                        
    albums-test-api-php-1       |       DoctrineMigrations\Version20231024193304  
    ```
3. Seed some faked data into DB in new terminal window.
    ```
    docker compose exec php \
    bin/console doctrine:fixtures:load --append
    ```

## API usage

`POST https://localhost/api/login` - will log in a user. It will create a token and save it in 
user record in database (column `token`). This token is returned in the Response in login request.

Body example:
```json
{
  "username": "amateri.user",
  "password": "amateri_password"
}
```

The returned token then should be set as an `X-TOKEN` header in any `/api/*` resource. For example:

```X-TOKEN: 905db59c371384518c4405ee58a30f829ee74259568a03dffec321230abac32b520ee0649e54bf13f5da19```

With this token you can access following resources:


1. `POST https://localhost/api/albums` - will create an album in DB. Returns `id` and `title` of the created album.

    Body example:
    ```json
    {
      "title": "test album",
      "description": "my super album",
      "images": [
          {
              "url": "http://test.com/image.jpg"
          }
      ]
    }
    ```

2. `GET https://localhost/api/albums` - gets all albums collection.
    
    Albums can be filtered by id of its owner. For example:

   `GET https://localhost/api/albums?ownerId=2`

3. `GET https://localhost/api/albums/{id_album}` - gets a specific album.

More API endpoints are listed on https://localhost/docs

## Space for improvements

This is a fresh implementation and here can be many thing to improve. I see some big problems here:
1. `env` variables are not ignored and pushed to GIT. This should not be like that,
but it is much easier to fast run and test this application.
2. Tokens of the logged user are saved into `token` column of user record in `user` database. 
I would improve it and create a new table specifically for tokens. So then we can handle different
access tokens for a specific user, so user can be logged it with different devices or can have different access tokens 
for different resources.
3. We can also add token expiration, token invalidation functionality to the application
