<div align="center">

![Laravel Zoho Books Package Banner](./images/laravel-zoho-books.png)
![License: MIT](https://img.shields.io/badge/License-MIT-blueviolet.svg)
![Repository Type](https://img.shields.io/badge/Type-package-orange)
![Latest Version](https://img.shields.io/packagist/v/sumer5020/laravel-zoho-books?color=blue&label=Version)
![Packagist Downloads](https://img.shields.io/packagist/dt/sumer5020/laravel-zoho-books?color=darkslategrey&label=Downloads)
![Stand With Palestine 🇵🇸](https://raw.githubusercontent.com/TheBSD/StandWithPalestine/main/badges/StandWithPalestine.svg)

[English](README.md) | [العربية](README.ar.md)

</div>

# Laravel Zoho Books

This Laravel package simplifies integration with Zoho Books Accounting System, streamlining API interactions for easier
accounting management.

## Requirements

| Software   | Version |
|:-----------|:--------|
| `php`      | `^8.2`  |
| `Composer` | `^2.4`  |
| `Laravel`  | `^11.0` |

## Features

- [x] Authentication end points
- [x] Contact end points
- [x] Contact Person end points
- [x] Estimate end points
- [x] Sales Order end points

<details><summary>Coming soon features ✨</summary>

- [ ] Bank Account end points
- [ ] Bank Rule end points
- [ ] Bank Transaction end points
- [ ] Base Currency Adjustment end points
- [ ] Bill end points
- [ ] Chart Of Account end points
- [ ] Credit Note end points
- [ ] Currency end points
- [ ] Customer Payment end points
- [ ] Custom Module end points
- [ ] Expense end points
- [ ] Invoice end points
- [ ] Item end points
- [ ] Journal end points
- [ ] Opening Balance end points
- [ ] Project end points
- [ ] Purchase Order end points
- [ ] Recurring Bill end points
- [ ] Recurring Expense end points
- [ ] Recurring Invoice end points
- [ ] Retainer Invoice end points
- [ ] Task end points
- [ ] Tax end points
- [ ] Time Entry end points
- [ ] User end points
- [ ] Vendor Credit end points
- [ ] Vendor Payment end points
- [ ] Zoho Crm Integration end points

</details>

## Installation

Install the package by using composer:

```sh
composer require sumer5020/laravel-zoho-books
```

## Publish the assets

Publish all assets

```sh
php artisan vendor:publish --provider=Sumer5020\ZohoBooks\ZohoBooksServiceProvider
```

Publish the configuration only:

```sh
php artisan vendor:publish --tag=zohoBooks.config
```

Publish the migrations only:

```sh
php artisan vendor:publish --tag=zohoBooks.migrations

# Migrate the database
php artisan migrate
```

Add this into your `.env` and add your details that come from `https://accounts.zoho.com/developerconsole`

```env
ZOHO_BOOKS_CLIENT_ID=
ZOHO_BOOKS_CLIENT_SECRET=
ZOHO_BOOKS_ACCESS_CODE=
ZOHO_BOOKS_REDIRECT_URI=
```

After that Run `php artisan zoho:init` command to initialize your credentials and insert `token`, `refresh_token`
and `expires_in` into `zoho_tokens` table.

> [!WARNING]
> We used `Self Client` to generate server-to-server access code. you must run the artisan command before the access
> code expired.

> [!NOTE]
> The `expires_in` is for the `token`, The `refresh_token` is lifetime until you revoke it.

> [!NOTE]
> In order to reduce the number of database requests and improve the performance you need to cache this token
> credentials with expire time equals the token expire time.

## Usage

### Setup 🚀

After publish

Add the `ZohoBooksFacade` in your controller or any class you need to use the package functionality on it

```php
use Sumer5020\ZohoBooks\Facades\ZohoBooksFacade;
# or
use ZohoBooks;
```

### Authenticate and Set Up

1. **Initialize Your Credentials**

   After running the `php artisan zoho:init` command, the access and refresh tokens will be stored in the `zoho_tokens` table. You can retrieve these tokens when making API calls.

2. **Refresh access token**

   To refresh expired access token, use:

   ```php
   $token = ZohoBooksFacade::authentications()->refreshAccessToken($refresh_token);
   ```

3. **Revoke access token**

   To revoke the access token, use:

   ```php
   $status = ZohoBooksFacade::authentications()->revokeRefreshAccessToken($access_token, $refresh_token);
   ```

> [!NOTE]
> Once you have the access token, you can use it to call various Zoho Books API endpoints.
> The package provides a clean interface for each entity.

### Working with Contacts

1. **Create a Contact**

   To create a new contact, use:

   ```php
   $contactData = new CreateContactDto([
       'contact_name' => '...',
       'company_name' => '...',
       // ... other fields
   ]);

   $response = ZohoBooksFacade::contacts()->create($token, $organizationId, $contactData);
   ```

2. **Update a Contact**

   To update an existing contact:

   ```php
   $updateContactData = new UpdateContactDto([
       'contact_name' => '...',
       // ... other fields
   ]);

   $response = ZohoBooksFacade::contacts()->update($token, $organizationId, $updateContactData);
   ```

3. **List Contacts**

   To list contacts with pagination:

   ```php
   $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
   $response = ZohoBooksFacade::contacts()->list($token, $organizationId, $paginationDto);
   ```

4. **Get a Specific Contact**

   To retrieve a specific contact's details:

   ```php
   $contactId = '...';
   $response = ZohoBooksFacade::contacts()->get($token, $organizationId, $contactId);
   ```

5. **Delete a Contact**

   To delete a contact:

   ```php
   $response = ZohoBooksFacade::contacts()->delete($token, $organizationId, $contactId);
   ```

### Working with Contact Persons

1. **Create a Contact Person**

   To create a new contact person, use:

   ```php
    $contactPersonData = new CreateContactPersonDto([
        'contact_id' => '...',
        'first_name' => '...',
        'last_name' => '...',
        // ... other fields
    ]);

    $response = ZohoBooksFacade::contactPersons()->create($token, $organizationId, $contactPersonData);
   ```

2. **Update a Contact Person**

   To update an existing contact person, use:

   ```php
    $updateContactPersonData = new UpdateContactPersonDto([
        'contact_id' => '...',
        'contact_person_id' => '...',
        'first_name' => '...',
        // ... other fields
    ]);

    $response = ZohoBooksFacade::contactPersons()->update($token, $organizationId, $updateContactPersonData);
   ```

3. **List Contacts Person**

   To list person, use with pagination:

   ```php
    $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
    $response = ZohoBooksFacade::contactPersons()->list($token, $organizationId, $contactId, $paginationDto);
   ```

4. **Get a Specific Contact Person**

   To retrieve a specific contact person details, use:

   ```php
    $getContactPersonDto = new GetContactPersonDto(['contact_id' => '...', 'contact_person_id' => '...']);
    $response = ZohoBooksFacade::contactPersons()->get($token, $organizationId, $getContactPersonDto);
   ```

5. **Delete a Contact Person**

   To delete a contact person, use:

   ```php
    $response = ZohoBooksFacade::contactPersons()->delete($token, $organizationId, $contactPersonId);
   ```

### Working with Estimates

1. **Create an Estimate**

   To create an estimate:

   ```php
   $estimateData = new CreateEstimateDto([
       'customer_id' => '...',
       'currency_id' => '...',
       // ... other fields
   ]);

   $response = ZohoBooksFacade::Estimates()->create($token, $organizationId, $estimateData);
   ```

2. **Update an Estimate**

   To update an existing estimate:

   ```php
   $updateEstimateData = new UpdateEstimateDto([
       'estimate_id' => '...',
       'customer_id' => '...',
       // ... other fields
   ]);

   $response = ZohoBooksFacade::Estimates()->update($token, $organizationId, $updateEstimateData);
   ```

3. **List Estimates**

   To list estimates:

   ```php
   $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
   $response = ZohoBooksFacade::Estimates()->list($token, $organizationId, $paginationDto);
   ```

4. **Get Estimate Details**

   To get details of a specific estimate:

   ```php
   $estimateId = 'estimate_id_here';
   $response = ZohoBooksFacade::Estimates()->get($token, $organizationId, $estimateId);
   ```

5. **Delete an Estimate**

   To delete an estimate:

   ```php
   $response = ZohoBooksFacade::Estimates()->delete($token, $organizationId, $estimateId);
   ```

### Working with Sales Orders

1. **Create a Sales Order**

   To create a new sales order:

   ```php
   $salesOrderData = new CreateSalesOrderDto([
       'customer_id' => '...',
       'currency_id' => '...',
       // ... other fields
   ]);

   $response = ZohoBooksFacade::salesOrders()->create($token, $organizationId, $salesOrderData);
   ```

2. **Update a Sales Order**

   To update an existing sales order:

   ```php
   $updateSalesOrderData = new UpdateSalesOrderDto([
       'salesorder_id' => '...',
       'customer_id' => '...',
       // ... other fields
   ]);

   $response = ZohoBooksFacade::salesOrders()->update($token, $organizationId, $updateSalesOrderData);
   ```

3. **List Sales Orders**

   To list sales orders:

   ```php
   $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
   $response = ZohoBooksFacade::salesOrders()->list($token, $organizationId, $paginationDto);
   ```

4. **Get a Specific Sales Order**

   To retrieve details of a sales order:

   ```php
   $salesOrderId = '...';
   $response = ZohoBooksFacade::salesOrders()->get($token, $organizationId, $salesOrderId);
   ```

5. **Delete a Sales Order**

   To delete a sales order:

   ```php
   $response = ZohoBooksFacade::salesOrders()->delete($token, $organizationId, $salesOrderId);
   ```

### Error Handling

When making API calls, exceptions may be thrown if something goes wrong. Make sure to handle exceptions properly:

```php
try {
    // Your API call
} catch (Exception $e) {
    // Handle the exception
    echo 'Error: ' . $e->getMessage();
}
```

## Usage Table

| Service          | Method                                     | Parameters                          | Parameter Content                                     | Is Mandatory  |
|:-----------------|:-------------------------------------------|:------------------------------------|:------------------------------------------------------|:--------------|
| **Contacts**     | `ZohoBooksFacade::contacts()->create()`   | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$contactData`                     | Instance of `CreateContactDto`                        | Yes           |
|                  | `ZohoBooksFacade::contacts()->update()`   | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$updateContactData`               | Instance of `UpdateContactDto`                        | Yes           |
|                  | `ZohoBooksFacade::contacts()->list()`     | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$paginationDto`                   | Instance of `PaginationDto`                           | No            |
|                  |                                           | `$contactFiltersDto`               | Instance of `ContactFiltersDto`                       | No            |
|                  | `ZohoBooksFacade::contacts()->get()`      | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$contactId`                       | ID of the contact to retrieve                         | Yes           |
|                  | `ZohoBooksFacade::contacts()->delete()`   | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$contactId`                       | ID of the contact to delete                           | Yes           |
| **ContactPersons**| `ZohoBooksFacade::contactPersons()->create()`| `$token`                         | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$contactPersonData`               | Instance of `CreateContactPersonDto`                  | Yes           |
|                  | `ZohoBooksFacade::contactPersons()->update()`| `$token`                         | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$updateContactPersonData`         | Instance of `UpdateContactPersonDto`                  | Yes           |
|                  | `ZohoBooksFacade::contactPersons()->list()`| `$token`                          | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$contactId`                       | ID of the related contact                              | Yes           |
|                  |                                           | `$paginationDto`                   | Instance of `PaginationDto`                           | No            |
|                  | `ZohoBooksFacade::contactPersons()->get()` | `$token`                          | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$getContactPersonDto`             | Instance of `GetContactPersonDto`                     | Yes           |
|                  | `ZohoBooksFacade::contactPersons()->delete()`| `$token`                        | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$contactPersonId`                 | ID of the contact person to delete                     | Yes           |
| **Estimates**    | `ZohoBooksFacade::Estimates()->create()`   | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$estimateData`                    | Instance of `CreateEstimateDto`                       | Yes           |
|                  | `ZohoBooksFacade::Estimates()->update()`   | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$updateEstimateData`              | Instance of `UpdateEstimateDto`                       | Yes           |
|                  | `ZohoBooksFacade::Estimates()->list()`     | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$paginationDto`                   | Instance of `PaginationDto`                           | Yes           |
|                  |                                           | `$estimateFiltersDto`              | Instance of `EstimateFiltersDto`                      | No            |
|                  | `ZohoBooksFacade::Estimates()->get()`      | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$estimateId`                      | ID of the estimate to retrieve                         | Yes           |
|                  | `ZohoBooksFacade::Estimates()->delete()`   | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$estimateId`                      | ID of the estimate to delete                           | Yes           |
| **SalesOrders**   | `ZohoBooksFacade::salesOrders()->create()`| `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$salesOrderData`                  | Instance of `CreateSalesOrderDto`                     | Yes           |
|                  | `ZohoBooksFacade::salesOrders()->update()`| `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$updateSalesOrderData`            | Instance of `UpdateSalesOrderDto`                     | Yes           |
|                  | `ZohoBooksFacade::salesOrders()->list()`   | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$paginationDto`                   | Instance of `PaginationDto`                           | Yes           |
|                  |                                           | `$salesOrderFiltersDto`            | Instance of `SalesOrderFiltersDto`                    | No            |
|                  | `ZohoBooksFacade::salesOrders()->get()`    | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$salesOrderId`                    | ID of the sales order to retrieve                      | Yes           |
|                  | `ZohoBooksFacade::salesOrders()->delete()` | `$token`                            | Access token for authorization                         | Yes           |
|                  |                                           | `$organizationId`                  | ID of the organization                                 | Yes           |
|                  |                                           | `$salesOrderId`                    | ID of the sales order to delete                        | Yes           |

## License

The MIT License (MIT). Please see [MIT license](LICENSE.md) File for more information.
