# Parking Lot

The office basement has a parking lot of 120 car parking space capacity out of which 20% is reserved for differently-abled and pregnant women since its
closest to the lift.

Reserving a parking space has become a tedious job and consumes a good amount of time, hence management has decided to
automate it based on a first come first serve basis with the following features.

This project is implemented using [Laravel PHP framework](https://laravel.com). The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

##### Requirements:
* Users can book a parking space 15 mins prior to arrival, in which he will get a parking number.
* If the user fails to reach in 30 mins then the allotted space again goes for rebooking (15 mins extra wait time). If
* Reserved space is occupied completely then the reserved users will be allotted general parking space.
* If 50% capacity is utilized, then 15 mins extra wait time will be eliminated (for both reserved and general).
* If there is a clash for the general use and reserved for a general parking spot than the reserved user will be a priority.

## Prerequisites
Need to install the following to configure the application:
* PHP >= 7.1
* MySQL >= 5.7
* Composer

## Installation
1. ### Clone the repository
```
git clone git@github.com:kiranjose92/parking-lot.git
```
2. ### Install packages using composer.
```
composer install
```
3. #### Create DB
    * Create a database in MySQL for the application

4. #### Create .env file
    * Copy and rename .env.example file as .env
    * Add database details in the file
    * Set your application key using the following command:
        ```
        php artisan key:generate
        ```

5. #### Run migration
    ```
    php artisan migrate
    ```

6.  #### Run seeder
    ```
    php artisan db:seed
    ```
7. #### Set up Virtual Host

    Add virtual host for the application with Document Root pointing to 
    the `public/` folder of the project

    **or**

    Running the following command:
    ```
    php artisan serve
    ```
    When you use the artisan command to serve the application, it will be available in the URL **http://127.0.0.1:8000**

## APIs

1. #### API to book a parking slot:

*Endpoint:* `/api/booking`

*HTTP Method:* `POST`

*Request Header:* `Content-Type:application/json`

*Sample Payload:*
```
{
	"email": "macey.lueilwitz@example.com"
}
```


2. #### API to get the count of all available parking slots

*Endpoint:* `/api/parking_slots?available=true`

*HTTP Method:* `GET`


3. #### API to get the count of all occupied parking slots

*Endpoint:* `/api/parking_slots?occupied=true`

*HTTP Method:* `GET`


4. #### API to get parking slot status counts 

*Endpoint:* `/api/parking_slots?available=true&occupied=true&booked=true&allotted=true`

*HTTP Method:* `GET`


5. #### API to get all registered users

*Endpoint:* `/api/registered_users`

*HTTP Method:* `GET`


1. #### API to update the status of a booking to 'arrived' or 'departed':

*Endpoint:* `/api/booking/{parking_number}`

*HTTP Method:* `PUT`

*Request Header:* `Content-Type:application/json`

*Sample Payload:*
```
{
	"status": "arrived"
}
```
