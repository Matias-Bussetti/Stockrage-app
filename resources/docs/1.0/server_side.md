# Server Side

-   [Migraciones](#section-1)
-   [SQL](#section-2)
-   [Models](#section-3)

<a name="section-1"></a>

## Migraciones

Vamos a comenzar, primero vamos a crear los modelos de las tablas:

![Entidad-Relación](/vendor/binarytorch/larecipe/assets/img/diagram_entity_relation.jpg)

En la consola (Linux) escribiremos:

```php
    php artisan make:model Item -m -f -s

    php artisan make:model Shelf -m -f -s

    php artisan make:model Rack -m -f -s
```

El comando generara un modelo Item con:

-   una migración (para generar una tabla en la base de datos)
-   un factory (para generar informacion de un modelo falsos)
-   un seeder (para guardar informacion falsa en la base de datos)

Luego, modificaremos los archivos creados en la carpeta database/migrations correspondientes a el comando realizo:

#### Item

```php
class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->tinyText('name');
            $table->integer('amount');
            $table->tinyInteger('column_start');
            $table->tinyInteger('column_end');
            $table->tinyInteger('row_start');
            $table->tinyInteger('row_end');
            $table->foreignIdFor(Shelf::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
```

#### Shelf

```php
class CreateShelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelves', function (Blueprint $table) {
            $table->id();
            $table->tinyText('name');
            $table->integer('amount');
            $table->tinyInteger('columns');
            $table->tinyInteger('rows');
            $table->foreignIdFor(Rack::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shelves');
    }
}
```

#### Rack

```php
class CreateRacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racks', function (Blueprint $table) {
            $table->id();
            $table->tinyText('name')->nullable(true);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('racks');
    }
}
```

---

<a name="section-2"></a>

## SQL

Abrimos la cosola, en este caso estamos en Ubuntu

```console
sudo mysql
```

Crearemos un base de datos con el nombre "stockrage"

```console
mysql> create database stockrage;
```

Tambien crearemos un usuario y le asignaremos todos los permisos de la base de datos

```console
mysql> create user 'stockrage_mysql_user'@localhost identified by '12345678';

mysql> grant all on stockrage.\* to 'stockrage_mysql_user'@'localhost';
```

Luego modificaremos el archivo .env los siguientes datos para que la aplicación utilice la base de dato creada.

```env
DB_DATABASE=stockrage
DB_USERNAME=stockrage_mysql_user
DB_PASSWORD=12345678
```

Luego correremos la migraciones con el siguiente comando:

```console
php arisan migrate
```

El output de la terminal sera:

```console
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (1,773.83ms)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (883.20ms)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (938.10ms)
Migrating: 2019_12_14_000001_create_personal_access_tokens_table
Migrated:  2019_12_14_000001_create_personal_access_tokens_table (1,270.76ms)
Migrating: 2022_03_02_205601_create_items_table
Migrated:  2022_03_02_205601_create_items_table (647.87ms)
Migrating: 2022_03_03_191119_create_shelves_table
Migrated:  2022_03_03_191119_create_shelves_table (635.04ms)
Migrating: 2022_03_03_191152_create_racks_table
Migrated:  2022_03_03_191152_create_racks_table (546.17ms)
```

Y eso el lo minimo que necesitamos para que nuestra aplicación de Laravel ya comience a guardar datos en la base de datos recien creada.

---

<a name="section-3"></a>

## Model

Configuraremos los modelos para poder hacer uso de la asignación en masa y tambien crearemos los metodos para hacer uso de las relaciones

#### Item

```php
class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['name','icon','amount'];

    protected $attributes = [
        'column_start' => 1,
        'column_end' => 2,
        'row_start' => 1,
        'row_end' => 2,
    ];

    public function shelf()
    {
        return $this->belongsTo(Shelf::class, 'shelf_id');
    }
}
```

#### Shelf

```php
class Shelf extends Model
{
    use HasFactory;

    protected $table = 'shelves';

    protected $fillable = ['name','rows','columns'];

    protected $attributes = [
        'type' => 0,
    ];

    public function rack()
    {
        return $this->belongsTo(Rack::class, 'rack_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
```

#### Rack

```php
class Rack extends Model
{
    use HasFactory;

    protected $table = 'racks';

    protected $fillable = ['name'];

    public function shelves()
    {
        return $this->hasMany(Comment::class);
    }
}
```

-   $table: nombre de la tabla la cual va a ser utilizada para guardar los modelos
-   $fillable: los atributos de un arreglo que utlizara para crear un modelo en caso que se utilize la asignación en masa
-   $attributes: los atributos por defecto que un modelo endra.
