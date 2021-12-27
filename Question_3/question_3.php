<?php

$mysqli = new mysqli("localhost", "root", "sido", "time_managment");
if ($mysqli->connect_error) {
     exit("Cloud not connect");
}

$sql = "SELECT s.name, p.level, c.day, c.start_time, c.end_time, m.name, t.fullname, h.name
            FROM courses c, modules m, halls h, teachers t, specialities s, promotions p
            WHERE c.mod_id = m.id 
                 AND t.id = c.teach_id 
                 AND h.id = c.hall_id
                 AND s.id = p.spec_id
                 AND c.promo_id = p.id
                 AND c.promo_id = 5";

$prep = $mysqli->prepare($sql);

// $prep->bind_param()
$prep->execute();
$prep->store_result();

$prep->bind_result($spec, $level, $day, $start_time, $end_time, $mod_name, $teacher_name, $hall_name);
$file = "question_3";
$path = $file . ".xml";
$dom = new DOMDocument("1.0", "utf-8");

$promo = ($level) . ($spec) . "2MGL";
echo "level " .  $level;
echo "spec" . $spec;

$emploi = $dom->createElement("emploi");
$emploi->setAttribute("promotion", $promo);

while ($prep->fetch()) {
     $seance = $dom->createElement("seance");
     $seance->setAttribute("day", $day);
     $seance->setAttribute("start", $start_time);
     $seance->setAttribute("end", $end_time);
     $seance->setAttribute("teacher", $teacher_name);
     $seance->setAttribute("module", $mod_name);
     $seance->setAttribute("salle", $hall_name);

     $emploi->appendChild($seance);
}

$dom->appendChild($emploi);

$dom->save($path);

$prep->fetch();
$prep->close();

echo "<script>alert('XML file created with successfull :)')</script>";
