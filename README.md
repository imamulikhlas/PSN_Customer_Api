# PSN Technical Test BackEnd - Customer API

## Introduction
Proyek ini adalah implementasi dari RESTful API dengan Laravel. API ini dirancang untuk mengelola data pelanggan dan alamat mereka. 

## Spesifikasi
API ini mematuhi pedoman RESTful dan dirancang dengan menggunakan PHP dengan Laravel dan MariaDB atau MySQL sebagai database.

## Installation
1. Clone repository ini.
~~~bash  
  git clone https://github.com/imamulikhlas/PSN_Customer_Api.git
~~~

2. Jalankan `composer install` untuk menginstall semua dependencies.
3. Copy file `.env.example` ke `.env` dan sesuaikan pengaturannya dengan lingkungan Anda.
4. Jalankan `php artisan key:generate` untuk mengenerate application key.
5. Jalankan `php artisan migrate` untuk membuat tabel di database.
6. Jalankan `php artisan serve` untuk menjalankan server.

## API Endpoints

### List Of Customer
- Endpoint: `/customer`
- Method: `GET`
- Description: Return a list of the customer in JSON format, the customer must be sorted by rating and alphabetically.

### Detail Of Customer
- Endpoint: `/customer/:id`
- Method: `GET`
- Description: Return the details of a customer and address in JSON format.

### Add New Customer
- Endpoint: `/customer`
- Method: `POST`
- Description: Add a customer to the customers list.
- Body example:
    ```json
    {
        "title": "Mr",
        "name": "Adrien Philippe",
        "gender": "M",
        "phone_number": "085222334445",
        "image": "https://img.freepik.com/premium-vector/man-avatar-profile-round-icon_24640-14044.jpg",
        "email": "adrien.philippe@gmail.com"
    }
    ```

### Add New Address
- Endpoint: `/address`
- Method: `POST`
- Description: Add a address to the address list.
- Body example:
    ```json
    {
        "customer_id" : "1",
        "address" : "Kawasan Karyadeka Pancamurni Blok A Kav. 3",
        "district" : "Cikarang Selatan",
        "city" : "Bekasi",
        "province" : "Jawa Barat",
        "postal_code" : 17530
    }
    ```

### Update Customer
- Endpoint: `/customer/:id`
- Method: `PATCH`
- Description: Update a customer to the customers list.
- Body example:
    ```json
    {
        "title": "Mr",
        "name": "Adrien Philippe",
        "gender": "M",
        "phone_number": "085222334445",
        "image": "https://img.freepik.com/premium-vector/man-avatar-profile-round-icon_24640-14044.jpg",
        "email": "adrien.philippe@gmail.com"
    }
    ```

### Update Address
- Endpoint: `/address/:id`
- Method: `PATCH`
- Description: Update a address to the address list.
- Body example:
    ```json
    {
        "address" : "Kawasan Karyadeka Pancamurni Blok A Kav. 3",
        "district" : "Cikarang Selatan",
        "city" : "Bekasi",
        "province" : "Jawa Barat",
        "postal_code" : 17530
    }
    ```

### Delete Customer
- Endpoint: `/customer/:id`
- Method: `DELETE`
- Description: Delete a customer and address from database.

### Delete Address
- Endpoint: `/address/:id`
- Method: `DELETE`
- Description: Delete a address from database.

## Testing
Anda dapat menjalankan unit test dengan command `php artisan test`.

## Logging
Log disimpan di `storage/logs/laravel.log`.

## Docker
Anda bisa menjalankan aplikasi ini dalam Docker. Pastikan Docker sudah terinstall di sistem Anda dan jalankan perintah berikut:

```
docker-compose up -d

```
Setelah itu, aplikasi dapat diakses di `http://localhost:8000`.
