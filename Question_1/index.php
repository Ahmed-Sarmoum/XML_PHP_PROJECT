<?php
$mysqli = new mysqli("localhost", "root", "sido", "time_managment");
if ($mysqli->connect_error) {
     exit("You Can't Connect to this database!!" . $mysqli->connect_error);
} else {
     echo "Connected Successfully :)";
}

$sql1 = "SELECT stud.id, firstname, lastname
               FROM students stud, promotions promo, specialities spec
               WHERE stud.promo_id = promo.id 
                    AND spec.id = promo.spec_id
                    AND promo.id =5";

$sql2 = "SELECT  modul.id, modul.name 
               FROM  modules modul, promotions promo, specialities spec
               WHERE modul.promo_id =promo.id 
                    AND spec.id = promo.spec_id 
                    AND promo.id =5";

$stmt = $mysqli->prepare($sql1);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($stud_id, $firstname, $lastname);
if ($stmt2 = $mysqli->prepare($sql2)) { // assuming $mysqli is the connection
     $stmt2->execute();
     $stmt2->store_result();
     $stmt2->bind_result($mod_id, $mod_name);
} else {
     $error = $mysqli->errno . ' ' . $mysqli->error;
     echo $error; // 1054 Unknown column 'foo' in 'field list'
}



echo "<h1>All Students</h1>";
echo "<table>";
echo "<tr>";
echo "<th>#ID</th>";
echo "<th>Firstname</th>";
echo "<th>Lastname</th>";
echo "</tr>";
while ($stmt->fetch()) {

     echo "<tr>";
     echo "<td>" . $stud_id . "</td>";
     echo "<td>" . $firstname  . "</td>";
     echo "<td>" . $lastname . "</td>";
     echo "</tr>";
}
echo "</br>";
echo "</br>";
echo "</br>";
echo "</table>";
echo "<h1>All Modules</h1>";
echo "<table>";
echo "<tr>";
echo "<th>#ID</th>";
echo "<th>Name</th>";
echo "</tr>";
while ($stmt2->fetch()) {

     echo "<tr>";
     echo "<td>" . $mod_id . "</td>";
     echo "<td>" . $mod_name  . "</td>";
     echo "</tr>";
}

echo "</table>";
$stmt->fetch();
$stmt->close();

$stmt2->fetch();
$stmt2->close();
