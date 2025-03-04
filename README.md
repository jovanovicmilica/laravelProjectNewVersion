# Supplier Parts Management API

This API allows users to manage parts, suppliers, and their relationships. It includes features like pagination, filtering, CSV export, and CRUD operations for parts and suppliers.

## Installation

Clone the repository:
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
   composer install

## Database Setup
    This project uses **Laravel migrations** to create the database schema and **seeders** to populate data from a CSV file.

 ## Running Migrations and Seeders
    Migrations are used to define and create database tables. To apply them, run:
    php artisan migrate
    Seeders are used for inserting initial data into the database. The .csv file is located at public/suppliers.csv
    php artisan db:seed
   
    php artisan serve

## API Endpoints
### Parts
    List all parts with pagination, search option by description and filter by supplier
    GET /parts
    Request body:
    {
        "per_page": "10", //optional 
        "supplier_id": 1, //optional, shoqing parts for specific supplier
        "key": "5250" //optional, searching part by part description
    }

    Update part by part_id
    PUT /parts/{id}
    Request body:
    {
        "part_number": "test part" //requird,
        "part_desc": "test description",
        "category_id": 1 //optional
    }

    Delete part by id
    DELETE /parts/{id}

### Suppliers
    List all suppliers
    GET /suppliers

    Update supplier by id
    PUT /suppliers/{id}
    Request body:
    {
        "supplier_name": "test part"
    }

    Delete supplier by id
    DELETE /suppliers/{id}

### SupplierParts
    List all supplier parst (as it is in .csv file)
    GET /supplier_parts
    Request body:
    {
        "per_page": "10", //optional 
    }

##Export parts for specific supplier
    GET /supplier/{supplier_id}/export
