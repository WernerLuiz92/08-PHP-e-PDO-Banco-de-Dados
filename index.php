<?php

$path = './App/';
$diretorio = dir($path);

while ($arquivo = $diretorio->read()) {
    if (!($arquivo === '.' || $arquivo === '..')) {
        echo "<a href='".$path.$arquivo."'>".$arquivo.'</a><br />';
    }
}
$diretorio->close();

// ? >
// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta http-equiv="X-UA-Compatible" content="IE=edge">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Doctrine ORM</title>
// </head>
// <body>

// </body>
// </html>
