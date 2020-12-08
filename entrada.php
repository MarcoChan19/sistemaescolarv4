<DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="node_modules\bulma\css\bulma.min.css">
    <script src="node_modules\axios\dist\axios.min.js"></script>
</head>
<body>
<h1></h1>
</body >
<article class="message">
  <div class="message-header" >
    <p></p>
    <button aria-label="delete"></button>
  </div>
  <div class="message-body">
     <strong>CALIFICACIONES</strong>
  </div>
</article>
</body>
</html>

<?php
use Illuminate\Database\Capsule\Manager as DB;
require __DIR__ . '\config\database.php';
require __DIR__ . '\vendor\autoload.php';

$promedio = DB::table('calificaciones')->avg('calificacion');
$promedio = number_format($promedio,1);

$calificaciones = DB::table('calificaciones')
->select('calificacion','idcalificaciones')
->get();

echo <<<_TABLE
<table class="table" background="plantillas.jpg">
<thead>
    <tr>
        <th></th>
        
        <th>calificacion</th>
        <td>$promedio</td>
        
    </tr>
</thead>
<tbody>
_TABLE;

foreach($calificaciones as $fila){
echo <<<_ROW
    <tr>
        <th></th>
        <td><center>$fila->calificacion</center></td>
        <td>
            <form action "update.php" method="post">
                <input id="idcalificaciones" type="text" name="idcalificaciones" 
                value="{$fila->idcalificaciones}" hidden>
                
            </form>
        </td>
    </tr>
_ROW;

}
echo "</tbody></table>";