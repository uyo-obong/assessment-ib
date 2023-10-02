# Assessment For Card Validation

## Tools Utilized

- Laravel (Backend)
- Vuejs (Frontend)

## How to run the application

- Clone the repository using git clone.
- Navigate to the backend directory (internet_brand).
- Run ```php artisan composer install```
- Run ```php artisan route:clear``` if you encounter any issue with the endpoint
- Finally run ```php artisan serve``` to spin up the application

Once the backend is up and running, you can access the endpoint using tools like Postman. The endpoint URL is http://127.0.0.1:8000/api/card/validation, and it accepts a POST request with the following JSON request body:
```json
{
    "card_name": "Uyo-obong",
    "card_number": "37054000158709160",
    "card_cvv": "3453",
    "card_expiry_month": "10",
    "card_expiry_year": "2023"
}
```

That's all you need to run the backend.


### Frontend

- Navigate to the internet-brand-frontend folder.
- run ```npm install```
- run ```npm run dev``` to spin up the frontend

That is all it takes to spin up the frontend application.

## Backend Requirements:
    1 PHP ^8.2
    2 Laravel 10.x
    3 Composer 2.x

## Frontend Requirements:
    1 Typescript
    2 Nodejs 20.x
    3 Vue cli 5.x






