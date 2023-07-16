## Reto Día 1
Este es el primer ejercicio de Laravel 10 
## CMS Para Principiantes en Laravel.

## Configuración inicial y base de datos:
1. Crear el proyecto con `laravel new example`.
2. Actualiza las credenciales de la base de datos en el archiv`.env`.
3. Crea la entidad o modelo
    `php artisan make:model Post -mf` 
        m: significa migraciones
        f: significa factory
4. Configuración de la migración. (campos).
```php
 public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('body');
        $table->enum('type', ['PAGE', 'POST'])->default('POST');
        $table->timestamps();
    });
}
```
5. Creamos la estructura en el factory. para llenar los datos en la base de datos.
```php
 public function definition()
{
    $title = fake()->sentence();
    return [
        'title' => $title,
        'slug'  => strtolower(
            str_replace(' ', '-', $title)
        ),
        'body'  => fake()->text(),
        //'type'  => ['PAGE', 'POST'], NOTE: LO ASIGNAMOS DESDE EL SEEDER. 
    ];
}
```
6. Creamos los Seeder. Es el molde para que podamos llenar o poblar a nuestras tablas utilizando el factory anterior.
```php
public function run()
{
    // \App\Models\User::factory(10)->create();

    \App\Models\Post::factory(36)->create();
    //Pages
    \App\Models\Post::factory()->create(['title' => 'Example',  'slug' => 'example',  'type' => 'PAGE']);
    \App\Models\Post::factory()->create(['title' => 'Features', 'slug' => 'features', 'type' => 'PAGE']);
    \App\Models\Post::factory()->create(['title' => 'Overview', 'slug' => 'overview', 'type' => 'PAGE']);
    \App\Models\Post::factory()->create(['title' => 'About',    'slug' => 'about',    'type' => 'PAGE']);

}
```
7. Ejecutamos las migraciones y que se ejecuten los seeder.
```bash
    php artisan migrate --seed

     INFO  Preparing database.  
      Creating migration table ............................................................................................................... 39ms DONE
     INFO  Running migrations.  

  2014_10_12_000000_create_users_table ................................................................................................... 64ms DONE
  2014_10_12_100000_create_password_resets_table ......................................................................................... 61ms DONE
  2019_08_19_000000_create_failed_jobs_table ............................................................................................. 43ms DONE
  2019_12_14_000001_create_personal_access_tokens_table .................................................................................. 68ms DONE
  2023_07_12_005810_create_posts_table ................................................................................................... 49ms DONE

   INFO  Seeding database.  
```

## Diseño Inicial
1. Crearmos el primer controlador.
```bash
php artisan make:controller PageController
```
2. Definimos en el controlador dos metodos [Post y Blog]
```php
   public function blog()
    {
        $page = Post::whereType('PAGE')->get();
        $post = post::whereType('POST')->orderByDESC('id')->get();
        return view('blog', compact('page', 'post'));
    }
```
3. Definimos la rutas para el controlador y los dos métodos en el archivo de Rutas.
```php
Route::get('/',            [PageController::class, 'blog'])->name('blog');
Route::get('/{post:slug}', [PageController::class, 'post'])->name('post');
```
4. Definimos nuestras vistas.
    4.1  cambio de nombre al archivo `welcome.blade.php` por `app.blade.php`.
    4.2  Limpiamos el body y los link del header para colcoar el link de cdn de boostrap



