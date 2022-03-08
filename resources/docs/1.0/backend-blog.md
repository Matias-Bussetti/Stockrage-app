# Blog del Server Side

-   [Empezando](#section-1)

<a name="section-1"></a>

### Empezando

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
            $table->tinyText('name');
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

### Conección a la base de datos

Ya que la aplicación se esta desarrollando en un entorno virtual utilizaremos el servicio de SQL
