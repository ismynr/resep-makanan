# Instalation
```
git clone [url]
cd [repo]
cp .env.example .env
composer install
```
env configuration
```
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve --port=8000
php artisan serve --port=8001
```

# API Kategori

    GET kategori
    
Returns a list of [Kategori][]

### Search fields
* kategori

## Example
### Request

    http://127.0.0.1:8001/api/kategori

### Response
``` json
{
    "message": "Berhasil mengambil data",
    "error": false,
    "code": 200,
    "data": [
        {
            "id": 1,
            "kategori": "Aneka Minuman",
            "created_at": "2021-10-25T23:08:15.000000Z",
            "updated_at": "2021-10-25T23:08:15.000000Z",
            "resep": []
        },
        {
            "id": 2,
            "kategori": "Menu Utama",
            "created_at": "2021-10-25T23:08:15.000000Z",
            "updated_at": "2021-10-25T23:08:15.000000Z",
            "resep": []
        },
    ]
}
```

### Request With Param

    http://127.0.0.1:8001/api/kategori?search={kategori}

### Response
``` json
{
    "message": "Berhasil mengambil data",
    "error": false,
    "code": 200,
    "data": [
        {
            "id": 3,
            "kategori": "Aneka Makanan",
            "created_at": "2021-10-25T13:31:10.000000Z",
            "updated_at": "2021-10-25T16:52:25.000000Z",
            "resep": [
                {
                    "id": 10,
                    "kategori_id": 3,
                    "nama": "Ayam Penyek",
                    "deskripsi": "Labore dolores fuga quam est dolor non soluta. Ut esse et architecto illum in.",
                    "created_at": "2021-10-25T13:31:10.000000Z",
                    "updated_at": "2021-10-25T17:23:41.000000Z"
                }
            ]
        }
    ]
}
```
