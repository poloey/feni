<?php
/**
 * create mvc file structures and boilerplate code
 * @return [void] [it will create file with content and folder]
 */
if (isset($argv[1])) {
  $args =  $argv[1];
  $args_explode = explode(':', $args);
  $key = $args_explode[0];
  $value = $args_explode[1];
  if ($key === 'c') {
    echo create_controller($value);
  }
  if ($key === 'v') {
    echo create_view($value);
  }
  if ($key === 'r') {
    echo create_route($value);
  }
  if ($key === 'rvc') {
    echo create_route($value);
    echo create_view($value);
    echo create_controller($value);
  }
}



function create_mvc_stucture () {
  if (!file_exists('core')) {
    mkdir('core');
  }
  if (!file_exists('core/db.php')) {
    $file = fopen('core/db.php', 'w');
    $content = <<<'TEXT'
<?php
class Db {
  public static function connect($config)
  {
    return new PDO($config['dsn'], $config['username'], $config['password'], $config['options'] );
  }
}
TEXT;
    fwrite($file, $content);
    fclose($file);
  }
  if (!file_exists('core/boot.php')) {
    $file = fopen('core/boot.php', 'w');
    $content = <<<'TEXT'
<?php
require 'config.php';
require 'core/Db.php';
require 'core/Query.php';
$connection = Db::connect($config);
$query = new Query($connection);
TEXT;
    fwrite($file, $content);
    fclose($file);
  }
  if (!file_exists('core/Query.php')) {
    $file = fopen('core/Query.php', 'w');
    $content = <<<'TEXT'
<?php
class Query {
  protected $connection;
  public function connect($db)
  {
    $this->connection = $db;
  }
}
TEXT;
    fwrite($file, $content);
    fclose($file);
  }
  if (!file_exists('config.php')) {
    $content = <<<'TEXT'
<?php
$config = [
  'dsn' => 'mysql:host=localhost;dbname=auth',
  'username' => 'root',
  'password' => '',
  'options' => []
];
TEXT;
    $file = fopen('config.php', 'w');
    fwrite($file, $content);
    fclose($file);
  }
  if (!file_exists('core')) {
    mkdir('core');
  }
  if (!file_exists('views')) {
    mkdir('views');
  }
  if (!file_exists('controllers')) {
    mkdir('controllers');
  }
  if (!file_exists('models')) {
    mkdir('models');
  }
}
create_mvc_stucture();

function create_controller ($name)  {
  $filename = "controllers/{$name}.controller.php";
  $file = fopen($filename, 'w');
  $content = <<<TEXT
  <?php 
require 'views/{$name}.view.php';
TEXT;
  fwrite($file, $content);
  fclose($file);
  return "{$filename} created successfully \n";
}

function create_view ($name)  {
  $filename = "views/{$name}.view.php";
  $file = fopen($filename, 'w');
  $content =  <<<'TEXT'
<!doctype html>
<html lang="en">
  <head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
TEXT;
  fwrite($file, $content);
  fclose($file);
  return "{$filename} created successfully \n";
}

function create_route ($name)  {
  $filename = "{$name}.php";
  $file = fopen($filename, 'w');
  $content = <<<TEXT
<?php 
require 'controllers/{$name}.controller.php';
TEXT;
  fwrite($file, $content);
  fclose($file);
  return "{$filename} created successfully \n";
}


