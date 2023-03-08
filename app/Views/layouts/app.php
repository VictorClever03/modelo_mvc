
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<main id="main" class="main">

    
<?php

/**
* LOAD PAGES HERE
* 
*/
$file = dirname(__DIR__). DIRECTORY_SEPARATOR . str_replace('.php','',$page).'.php';
require_once $file;

?>



</main><!-- End #main -->
</body>
</html>
  