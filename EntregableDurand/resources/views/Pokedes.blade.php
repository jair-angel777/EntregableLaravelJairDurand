<?php

echo "<h2>LISTA DE POKEMONES : <br> </h2>";
echo "<table border='10' >";

echo "<tr>";
echo "<td> # </td>";
echo "<td> POKEMON </td>";
echo "<td> Imagenes Oficiales </td>";
echo "</tr>";

foreach ($Todoslospokemones as $po) {
    echo "<tr>";
    echo "<td>". $po['id']. "</td>";
    echo "<td>" . $po['name'] . "</td>";
    echo "<td> <img src='" . $po['image'] . "' style='width: 100px;'> </td>"; 
    echo "</tr>";
};

echo "</table>";
?>