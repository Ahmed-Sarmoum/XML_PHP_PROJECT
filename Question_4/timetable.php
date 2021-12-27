<?php
$mysqli = new mysqli("localhost", "root", "sido", "time_managment");
if ($mysqli->connect_error) {
     exit('you can not connect to this database ??' . $mysqli->connect_error);
}

$sql = "SELECT s.name, p.level, c.day, c.start_time, c.end_time, t.fullname, m.name, h.name
               FROM courses c, modules m, halls h, teachers t, specialities s, promotions p
               WHERE c.mod_id = m.id
                    AND t.id = c.teach_id
                    AND h.id = c.hall_id
                    AND s.id = p.spec_id
                    AND c.promo_id = p.id
                    AND c.promo_id = ?";

$pr = $mysqli->prepare($sql);
$pr->bind_param("i", $_GET["promo_id"]);
$pr->execute();
$pr->store_result();

$pr->bind_result($s_name, $level, $day, $start_time, $end_time, $t_name, $m_name, $h_name);

echo "<table>";

echo "<tr>";
echo "<th>Day</th>";
echo "<th>Start</th>";
echo "<th>End</th>";
echo "<th>Teacher</th>";
echo "<th>Module</th>";
echo "<th>Hall</th>";
echo "</tr>";

while ($pr->fetch()) {
     echo "<tr>";
     echo "<td>" . $day . "</td>";
     echo "<td>" . $start_time . "</td>";
     echo "<td>" . $end_time . "</td>";
     echo "<td>" . $t_name . "</td>";
     echo "<td>" . $m_name . "</td>";
     echo "<td>" . $h_name . "</td>";
     echo "</tr>";
}

echo "</table>";

$pr->fetch();
$pr->close();
