<?php

$con = new mysqli("localhost", "root", "sido", "time_managment");
if ($con->connect_error) {
     exit("you can not connect to this database :( ");
}

$sql = "SELECT s.id, firstname, lastname
                    FROM specialities spec, promotions p, students s
                    WHERE s.promo_id = p.id
                         AND spec.id = p.spec_id
                         AND p.id = ?";

$sql2 = "SELECT m.id, m.name
     FROM specialities s, promotions p, modules m
     WHERE m.promo_id = p.id
          AND s.id = p.spec_id
          AND p.id = ?";

$pr = $con->prepare($sql);
$pr->bind_param("i", $_GET["promo_id"]);
$pr->execute();
$pr->store_result();

$pr2 = $con->prepare($sql2);
$pr2->bind_param("i", $_GET["promo_id"]);
$pr2->execute();
$pr2->store_result();

$pr->bind_result($studId, $firstname, $lastname);
$pr2->bind_result($modId, $modName);

echo "<h2>Students List</h2>";
echo "<table style='border:1px solid #fff' border='1' class='center'>";
echo "<tr>";
echo "<th>Ins Num</th>";
echo "<th>Firstname</th>";
echo "<th>Lastname</th>";
echo "</tr>";

while ($pr->fetch()) {
     echo "<tr>";
     echo "<td>" . $studId . "</td>";
     echo "<td>" . $firstname  . "</td>";
     echo "<td>" . $lastname . "</td>";
     echo "</tr>";
}
echo "</table>";
echo "<h2>Modules List</h2>";
echo "<table  style='border:1px solid #fff' border='1' class='center'>";

echo "<th>Mod ID</th>";
echo "<th>Mod Name</th>";
echo "</tr>";
while ($pr2->fetch()) {

     echo "<tr>";
     echo "<td>" . $modId . "</td>";
     echo "<td>" . $modName  . "</td>";
     echo "</tr>";
}

echo "</table>";
$pr->fetch();
$pr->close();
