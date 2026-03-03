<div align="center">

![يانر لارافيل زوهو بوكس](./images/laravel-zoho-books.png)
![الرخصة: MIT](https://img.shields.io/badge/License-MIT-blueviolet.svg)
![نوع المستودع](https://img.shields.io/badge/Type-package-orange)
![أحدث إصدار](https://img.shields.io/packagist/v/sumer5020/laravel-zoho-books?color=blue&label=Version)
![عدد التحميلات](https://img.shields.io/packagist/dt/sumer5020/laravel-zoho-books?color=darkslategrey&label=Downloads)
![🇵🇸 قف بجانب فلسطين](https://raw.githubusercontent.com/TheBSD/StandWithPalestine/main/badges/StandWithPalestine.svg)

[English](README.md) | [العربية](README.ar.md)

</div>

<div dir="rtl" align="right">

# لارافيل زوهو المحاسبية

تقوم هذه الحزمة بتبسيط التكامل مع نظام المحاسبة زوهو بوكس، مما يسهل إدارة التفاعلات مع واجهة برمجة التطبيقات لتبسيط
تمرير عمليات المحاسبة.


## المتطلبات

| الاصدار | البرمجية   |
|:--------|:-----------|
| `^8.2`  | `php`      |
| `^2.4`  | `Composer` |
| `^11.0` | `Laravel`  |

## الميزات

<div dir="ltr" align="left">

- [x] Authentication end points
- [x] Contact end points
- [x] Contact Person end points
- [x] Estimate end points
- [x] Sales Order end points

</div>

<details><summary>الميزات القادمة قريبًا ✨</summary>

<div dir="ltr" align="left">

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
- [ ] Sales Order end points
- [ ] Task end points
- [ ] Tax end points
- [ ] Time Entry end points
- [ ] User end points
- [ ] Vendor Credit end points
- [ ] Vendor Payment end points
- [ ] Zoho Crm Integration end points

</div>

</details>

## التثبيت

قم بتثبيت الحزمة باستخدام Composer:

<div dir="ltr" align="left">

```sh
composer require sumer5020/laravel-zoho-books
```

</div>


## نشر الأصول

نشر جميع الأصول:

<div dir="ltr" align="left">

```sh
php artisan vendor:publish --provider=Sumer5020\ZohoBooks\ZohoBooksServiceProvider
```

</div>

نشر الإعدادات فقط:

<div dir="ltr" align="left">

```sh
php artisan vendor:publish --tag=zohoBooks.config
```

</div>

نشر قواعد البيانات فقط:

<div dir="ltr" align="left">

```sh
php artisan vendor:publish --tag=zohoBooks.migrations

# ترحيل قواعد البيانات
php artisan migrate
```

</div>

أضف التالي إلى ملف .env الخاص بك وأضف بياناتك والتي تم اخذها من `https://accounts.zoho.com/developerconsole`

<div dir="ltr" align="left">

```env
ZOHO_BOOKS_CLIENT_ID=
ZOHO_BOOKS_CLIENT_SECRET=
ZOHO_BOOKS_ACCESS_CODE=
ZOHO_BOOKS_REDIRECT_URI=
```

</div>

بعد ذلك، قم بتشغيل الأمر `php artisan zoho:init` لتفعيل بيانات الاعتماد الخاصة بك
وإدخال `token`, `refresh_token`, `expires_in` الى جدول `zoho_tokens`.

> [!WARNING]
> استخدمنا `Self Client` لإنشاء رمز وصول الخادم إلى الخادم. يجب تشغيل الأمر في موجه الاوامر قبل انتهاء صلاحية رمز
> الوصول.

> [!NOTE]
> ملاحظة: مدة صلاحية `expires_in` هي لـ `token،` بينما `refresh_token` صالح مدى الحياة حتى تقوم بإلغائه.

> [!NOTE]
> ملاحظة: لتقليل عدد الطلبات إلى قاعدة البيانات وتحسين الأداء، يجب عليك تخزين بيانات اعتماد رمز المصادقة مع وقت انتهاء
> يساوي مدة صلاحية الرمز في التخزين مؤقت.

## الاستخدام

### الإعداد 🚀

بعد نشر الاصول أضف `ZohoBooksFacade` في وحدة التحكم الخاصة بك أو أي فئة تحتاج إلى استخدام وظائف الحزمة بها:

<div dir="ltr" align="left">

```php
use Sumer5020\ZohoBooks\Facades\ZohoBooksFacade;
# أو
use ZohoBooks;
```

</div>

### المصادقة والإعداد

1. **تهيئة بيانات الاعتماد الخاصة بك**

   بعد تشغيل الأمر `php artisan zoho:init`، سيتم تخزين رموز الوصول والتحديث في جدول `zoho_tokens`. يمكنك استرداد هذه الرموز عند إجراء مكالمات واجهة برمجة التطبيقات.

2. **تحديث رمز الوصول**

   لتحديث رمز الوصول المنتهي، استخدم:

    <div dir="rtl" align="left">

    ```php
    $token = ZohoBooksFacade::authentications()->refreshAccessToken($refresh_token);
    ```

    </div>

3. **إلغاء رمز الوصول**

    <div dir="rtl" align="left">

    ```php
    $status = ZohoBooksFacade::authentications()->revokeRefreshAccessToken($access_token, $refresh_token);
    ```

    </div>

> [!NOTE]
> بمجرد حصولك على رمز الوصول، يمكنك استخدامه لاستدعاء نقاط نهاية واجهة برمجة التطبيقات المختلفة في زوهو بوكس.
> توفر الحزمة واجهة نظيفة لكل كيان.

### التعامل مع الاتصالات

1. **إنشاء اتصال**

    <div dir="rtl" align="left">

    ```php
    $contactData = new CreateContactDto([
        'contact_name' => '...',
        'company_name' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::contacts()->create($token, $organizationId, $contactData);
    ```

   </div>

2. **تحديث اتصال**

    <div dir="rtl" align="left">

    ```php
    $updateContactData = new UpdateContactDto([
        'contact_name' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::contacts()->update($token, $organizationId, $updateContactData);
    ```

   </div>

3. **قائمة الاتصالات**

    <div dir="rtl" align="left">

    ```php
    $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
    $response = ZohoBooksFacade::contacts()->list($token, $organizationId, $paginationDto);
    ```

   </div>

4. **الحصول على تفاصيل اتصال محدد**

    <div dir="rtl" align="left">

    ```php
    $contactId = '...';
    $response = ZohoBooksFacade::contacts()->get($token, $organizationId, $contactId);
    ```

    </div>

5. **حذف اتصال**

    <div dir="rtl" align="left">

    ```php
    $response = ZohoBooksFacade::contacts()->delete($token, $organizationId, $contactId);
    ```

    </div>

### العمل مع الأشخاص المرتبطين بالاتصال

1. **إنشاء شخص مرتبط بالاتصال**

    <div dir="rtl" align="left">

    ```php
    $contactPersonData = new CreateContactPersonDto([
        'contact_id' => '...',
        'first_name' => '...',
        'last_name' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::contactPersons()->create($token, $organizationId, $contactPersonData);
    ```

    </div>

2. **تحديث شخص مرتبط بالاتصال**

    <div dir="rtl" align="left">

    ```php
    $updateContactPersonData = new UpdateContactPersonDto([
        'contact_id' => '...',
        'contact_person_id' => '...',
        'first_name' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::contactPersons()->update($token, $organizationId, $updateContactPersonData);
    ```

    </div>

3. **قائمة الأشخاص المرتبطين بالاتصال**

    <div dir="rtl" align="left">

    ```php
    $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
    $response = ZohoBooksFacade::contactPersons()->list($token, $organizationId, $contactId, $paginationDto);
    ```

    </div>

4. **الحصول على تفاصيل شخص مرتبط بالاتصال**

    <div dir="rtl" align="left">

    ```php
    $getContactPersonDto = new GetContactPersonDto(['contact_id' => '...', 'contact_person_id' => '...']);
    $response = ZohoBooksFacade::contactPersons()->get($token, $organizationId, $getContactPersonDto);
    ```

    </div>

5. **حذف شخص مرتبط بالاتصال**

    <div dir="rtl" align="left">

    ```php
    $response = ZohoBooksFacade::contactPersons()->delete($token, $organizationId, $contactPersonId);
    ```

    </div>

### العمل مع التقديرات

1. **إنشاء تقدير**

    <div dir="rtl" align="left">

    ```php
    $estimateData = new CreateEstimateDto([
        'customer_id' => '...',
        'currency_id' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::Estimates()->create($token, $organizationId, $estimateData);
    ```

    </div>

2. **تحديث تقدير**

    <div dir="rtl" align="left">

    ```php
    $updateEstimateData = new UpdateEstimateDto([
        'estimate_id' => '...',
        'customer_id' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::Estimates()->update($token, $organizationId, $updateEstimateData);
    ```

    </div>

3. **قائمة التقديرات**

    <div dir="rtl" align="left">

    ```php
    $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
    $response = ZohoBooksFacade::Estimates()->list($token, $organizationId, $paginationDto);
    ```

    </div>

4. **الحصول على تفاصيل تقدير محدد**

    <div dir="rtl" align="left">

    ```php
    $estimateId = '...';
    $response = ZohoBooksFacade::Estimates()->get($token, $organizationId, $estimateId);
    ```

    </div>

5. **حذف تقدير**

    <div dir="rtl" align="left">

    ```php
    $response = ZohoBooksFacade::Estimates()->delete($token, $organizationId, $estimateId);
    ```

    </div>

### العمل مع أوامر البيع

1. **إنشاء أمر بيع**

    <div dir="rtl" align="left">

    ```php
    $salesOrderData = new CreateSalesOrderDto([
        'customer_id' => '...',
        'currency_id' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::salesOrders()->create($token, $organizationId, $salesOrderData);
    ```

    </div>

2. **تحديث أمر بيع**

    <div dir="rtl" align="left">

    ```php
    $updateSalesOrderData = new UpdateSalesOrderDto([
        'salesorder_id' => '...',
        'customer_id' => '...',
        // ... حقول أخرى
    ]);

    $response = ZohoBooksFacade::salesOrders()->update($token, $organizationId, $updateSalesOrderData);
    ```

    </div>

3. **قائمة أوامر البيع**

    <div dir="rtl" align="left">

    ```php
    $paginationDto = new PaginationDto(['page' => 1, 'per_page' => 10]);
    $response = ZohoBooksFacade::salesOrders()->list($token, $organizationId, $paginationDto);
    ```

    </div>

4. **الحصول على تفاصيل أمر بيع محدد**

    <div dir="rtl" align="left">

    ```php
    $salesOrderId = '...';
    $response = ZohoBooksFacade::salesOrders()->get($token, $organizationId, $salesOrderId);
    ```

    </div>

5. **حذف أمر بيع**

    <div dir="rtl" align="left">

    ```php
    $response = ZohoBooksFacade::salesOrders()->delete($token, $organizationId, $salesOrderId);
    ```

    </div>

### معالجة الأخطاء

عند إجراء مكالمات واجهة برمجة التطبيقات، قد يتم طرح استثناءات إذا حدث خطأ ما. تأكد من معالجة الاستثناءات بشكل صحيح:

<div dir="rtl" align="left">

```php
try {
    // مكالمة واجهة برمجة التطبيقات الخاصة بك
} catch (Exception $e) {
    // معالجة الاستثناء
    echo 'خطأ: ' . $e->getMessage();
}
```

</div>

## جدول الاستخدام

<div dir="rtl" align="right">

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

</div>

</div>
