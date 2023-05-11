# API SPECIFICATION

## Register

Request:
- Method: POST
- Endpoint: `/api/auth/register`
- Header: 
  - Content-Type: application/json
  - Accept: application/json
- Body:

```json
{
  "name": "string",
  "email": "string|unique",
  "password": "string",
  "password_confirmation": "string"
}
```

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "id": "string",
    "name": "string",
    "email": "string",
    "email_verified_at": "date",
    "phone_number": "integer",
    "avatar": "string",
    "created_at": "date",
    "updated_at": "date"
  },
  "token": "string"
}
```

## Login

Request:
- Method: POST
- Endpoint: `/api/auth/login`
- Header: 
  - Content-Type: application/json
  - Accept: application/json
- Body:

```json
{
  "email": "string",
  "password": "string"
}
```

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "id": "string",
    "name": "string",
    "email": "string",
    "email_verified_at": "date",
    "phone_number": "integer",
    "avatar": "string",
    "created_at": "date",
    "updated_at": "date"
  },
  "token": "string"
}
```

## Forgot Password

Request:
- Method: POST
- Endpoint: `/api/auth/forgot-password`
- Header: 
  - Content-Type: application/json
  - Accept: application/json
- Body:

```json
{
  "email": "string"
}
```

- Response:

```json
{
  "code": "number",
  "status": "string",
  "message": "string"
}
```

## Reset Password

Request:
- Method: POST
- Endpoint: `/api/auth/reset-password`
- Header:
  - Content-Type: application/json
  - Accept: application/json
- Body:

```json
{
  "token": "string",
  "email": "string|unique",
  "password": "string",
  "password_confirmation": "string"
}
```

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "id": "string",
    "name": "string",
    "email": "string",
    "email_verified_at": "date",
    "phone_number": "integer",
    "avatar": "string",
    "created_at": "date",
    "updated_at": "date"
  },
  "token": "string"
}
```

## Change Password

Request:
- Method: PATCH
- Endpoint: `/api/auth/change-password/{user_id}`
- Header: 
  - Authorization: `Bearer $token`
  - Content-Type: application/json
  - Accept: application/json
- Body:

```json
{
  "current_password": "string",
  "password": "string",
  "password_confirmation": "string"
}
```

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "id": "string",
    "name": "string",
    "email": "string",
    "email_verified_at": "date",
    "phone_number": "integer",
    "avatar": "string",
    "created_at": "date",
    "updated_at": "date"
  }
}
```

## Update User

Request:
- Method: PATCH
- Endpoint: `/api/users/{user_id}`
- Header: 
  - Authorization: `Bearer $token`
  - Content-Type: application/json
  - Accept: application/json
- Body:

```json
{
  "avatar": "string",
  "name": "string",
  "phone_number": "string"
}
```

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "id": "string",
    "name": "string",
    "email": "string",
    "email_verified_at": "date",
    "phone_number": "integer",
    "avatar": "string",
    "created_at": "date",
    "updated_at": "date"
  }
}
```

## Logout

Request:
- Method: POST
- Endpoint: `/api/auth/logout`
- Header: 
  - Authorization: `Bearer $token`
  - Accept: application/json

- Response:

```json
{
  "code": "number",
  "status": "string",
  "message": "string"
}
```

## Get All Doctors

Request:
- Method: GET
- Endpoint: `/api/doctors`
- Query:
  - page: 1,
  - per_page: 10,
  - specialist: null,
  - active: 0 or 1 (default 0),
- Header: 
  - Authorization: `Bearer $token`
  - Accept: application/json

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": [
    {
      "id": "string",
      "avatar": "string",
      "name": "string",
      "specialist": "string",
      "date": "date",
      "office_hours": "string",
      "room": "string",
      "active": "boolean",
      "created_at": "date",
      "updated_at": "date"
    }
  ],
  "links": {
    "first": "string",
    "last": "string",
    "prev": "string",
    "next": "string"
  },
  "meta": {
    "current_page": "integer",
    "from": "integer",
    "last_page": "integer",
    "links": [
      {
        "url": "string",
        "label": "string",
        "active": "boolean"
      }
    ],
    "path": "string",
    "per_page": "integer",
    "to": "integer",
    "total": "integer"
  }
}
```

## Store Registration Patient

Request:
- Method: POST
- Endpoint: `/api/patients`
- Header: 
  - Authorization: `Bearer $token`
  - Content-Type: application/json
  - Accept: application/json
- Body:

```json
{
  "name": "string",
  "date_of_birth": "date",
  "address": "string",
  "patient": "enum('General', 'JKN')",
  "allergy": "string",
  "status": "enum('Married', 'Single')",
  "gender": "enum('Male', 'Female')",
  "doctor_id": "string"
}
```

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "id": "string",
    "name": "string",
    "date_of_birth": "date",
    "address": "string",
    "patient": "enum('General', 'JKN')",
    "allergy": "string",
    "status": "enum('Married', 'Single')",
    "gender": "enum('Male', 'Female')",
    "doctor_id": "string",
    "created_at": "date",
    "updated_at": "date"
  }
}
```

## Get History Patient

Request:
- Method: GET
- Endpoint: `/api/forms/{user_id}`
- Header: 
  - Authorization: `Bearer $token`
  - Accept: application/json

- Response:

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "file": "string"
  }
}
```
