# API Documentation

### Introduction

Authentication with APIs in Laravel



### Endpoints

# Register User

This endpoint allows you to register a new user.

## Request

**HTTP Request**

`POST {{url}}/register`

**Parameters**

- `name` (text) - The name of the user.
- `username` (text) - The username of the user.
- `password` (text) - The password for the user's account.
- `password_confirmation` (text) - Confirmation of the password.
- `email` (text) - The email address of the user.
- `contact` (text) - The contact information of the user.
    

## Response

- Status: 200
- Content-Type: application/json
    

``` json
{
    "success": true,
    "message": "",
    "data": {
        "user": {
            "id": 0,
            "name": "",
            "email": "",
            "contact": "",
            "username": "",
            "email_verified_at": null,
            "created_at": "",
            "updated_at": ""
        },
        "token": "",
        "tokenType": ""
    }
}

 ```

# Login

This endpoint is used to authenticate and login a user.

## Request

- Method: POST
- URL: `{{url}}/login`
- Body (form-data):
    - `username` (text): The username of the user.
    - `password` (text): The password of the user.

## Response

- Status: 200
- Content-Type: application/json
- Body:
    
    ``` json
    {
      "success": true,
      "message": "",
      "data": {
        "user": {
          "id": 0,
          "name": "",
          "email": "",
          "contact": "",
          "username": "",
          "email_verified_at": null,
          "created_at": "",
          "updated_at": ""
        },
        "token": "",
        "tokenType": ""
      }
    }
    
     ```

# Profile API

This API endpoint makes an HTTP GET request to retrieve the profile information.

## Request

The request does not require any parameters or payload.

## Response

- Status: 200
- Content-Type: application/json
    

Example Response Body:

``` json
{
    "success": true,
    "message": "",
    "data": {
        "id": 0,
        "name": "",
        "email": "",
        "contact": "",
        "username": "",
        "email_verified_at": null,
        "created_at": "",
        "updated_at": ""
    }
}

 ```

The response includes a "success" flag, an optional "message", and profile data including "id", "name", "email", "contact", "username", "email_verified_at", "created_at", and "updated_at".
    
    - `success`: Indicates if the login was successful.
    - `message`: Additional information or error message.
    - `data.user`: User information if login is successful.
    - `data.token`: Authentication token.
    - `data.tokenType`: Type of the authentication token.
