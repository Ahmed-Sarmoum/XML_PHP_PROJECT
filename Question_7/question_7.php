<?php
$mysqli = new mysqli("localhost", "root", "sido", "time_managment");

$sql1 = "SELECT s.id, firstname, lastname
               FROM specialities spec, promotions p, students s
               WHERE s.promo_id = p.id 
                    AND spec.id = p.spec_id
                    AND p.id = 5";

$sql2 = "SELECT  s.name , p.level
               FROM specialities s,promotions p
               WHERE s.id=p.spec_id 
                    AND p.id = 5";

$sql3 = "SELECT  m.id, m.name
               FROM specialities s,promotions p,modules m
               WHERE m.promo_id=p.id
                    AND s.id = p.spec_id
                    AND p.id = 5";

$pr1 = $mysqli->prepare($sql1);
$pr1->execute();
$pr1->store_result();

$pr1->bind_result($stud_id, $f_name_stud, $l_name_stud);

$pr2 = $mysqli->prepare($sql2);
$pr2->execute();
$pr2->store_result();

$pr2->bind_result($spec_name, $level);

$pr3 = $mysqli->prepare($sql3);
$pr3->execute();
$pr3->store_result();

$pr3->bind_result($mod_id, $mod_name);

$path = "question_7.xml";

$document = new DOMDocument('1.0', 'utf-8');

$pr2->fetch();
$prom = $document->createElement("promotion");
$prom->setAttribute("option", $spec_name);
$prom->setAttribute("level", $level);

$students = $document->createElement("students");
while ($pr1->fetch()) {
     $student = $document->createElement("student");

     $student->setAttribute("insNum", $stud_id);
     $student->setAttribute("firstname", $f_name_stud);
     $student->setAttribute("lastname", $l_name_stud);

     $students->appendChild($student);
}

$modules = $document->createElement("modules");
while ($pr3->fetch()) {
     $module = $document->createElement("module");

     $module->setAttribute("modId", $mod_id);
     $module->setAttribute("modName", $mod_name);

     $modules->appendChild($module);
}

$prom->appendChild($students);
$prom->appendChild($modules);
$document->appendChild($prom);

$document->save($path);

$pr1->fetch();
$pr1->close();

echo "<script>alert('XML file created with success :)')</script>";
