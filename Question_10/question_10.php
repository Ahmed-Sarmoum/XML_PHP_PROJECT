<!DOCTYPE html>
<html>

<head>
     <link rel="stylesheet" href="../style/style.css">
     <style>
          * {
               margin: 0;
               padding: 0;
          }

          #container {
               height: 100%;
               width: 100%;
               font-size: 0;
          }

          #left,
          #middle,
          #right {
               display: inline-block;
               *display: inline;
               vertical-align: top;
               font-size: 12px;
          }

          #left {
               width: 100%;
               background-color: rgba(255, 255, 255, 0.2);
          }

          #middle {
               width: 100%;
          }

          #right {
               width: 25%;
               background: yellow;
          }

          h1 {
               text-align: center;
               color: white;
               font-family: verdana;
               font-size: 300%;

          }

          h2 {
               color: white;
               font-family: courier;
               font-size: 160%;

          }

          .center {
               margin: auto;
               width: 100%;
               padding: 10px;

          }

          select {
               display: inline;
          }

          button[name=button] {
               margin: auto;
               width: 50%;
               padding: 10px;
               background: green;
               color: white;
               padding: 14px 20px;
               margin: 8px 26%;
               border: none;
               border-radius: 4px;
               cursor: pointer;
          }


          div {
               width: 90%;
               border-radius: 10px;
               padding: 10px;
          }

          label {
               width: 12%;
               margin: 24px 0px 22px 16px;
               color: white;
          }
     </style>

</head>


<body>
     <?php
     $mysqli = new mysqli("localhost", "root", "sido", "time_managment");
     if ($mysqli->connect_error) {
          exit('you cannot connect to database :(');
     }
     $sql = "SELECT t.fullname from teachers t";
     $sql1 = "SELECT m.name from modules m";
     $sql2 =  "SELECT h.name from halls h";
     $pr = $mysqli->prepare($sql);
     $pr->execute();
     $pr->store_result();

     $pr1 = $mysqli->prepare($sql1);
     $pr1->execute();
     $pr1->store_result();

     $pr2 = $mysqli->prepare($sql2);
     $pr2->execute();
     $pr2->store_result();

     $pr->bind_result($teach_name);
     $pr1->bind_result($mod_name);
     $pr2->bind_result($salle_name);

     $sql3 = "SELECT s.name, p.level, p.id 
                              FROM specialities s,promotions p
                              WHERE s.id = p.spec_id";

     $pr3 = $mysqli->prepare($sql3);
     $pr3->execute();
     $pr3->store_result();
     $pr3->bind_result($spec_name, $level, $promo_id);

     ?>

     <h1>Timetable </h1>

     <div style="margin:auto">
          <div id="left">
               <form style="margin:auto;">
                    <div style="display: inline-flex;">
                         <label for="promotion">Select a promotion</label>
                         <select id="prom" name="promo">
                              <?php
                              while ($pr3->fetch()) {
                                   $promo = ($level) . ($spec_name);
                                   echo "<option value= " . $promo_id . ">"  . $promo . "</option>";
                              }
                              ?>
                         </select>
                         <label for="day">Day</label>
                         <select id="day" name="day">
                              <option value="Sunday">Sunday</option>
                              <option value="Monday">Monday</option>
                              <option value="Tuesday">Tuesday</option>
                              <option value="Wednesday">Wednesday</option>
                              <option value="Thusday">Thusday</option>

                         </select>
                    </div>

                    <div style="display: inline-flex;">
                         <label for="start">Start :</label>
                         <select id="start" name="start">
                              <option value="08:00:00">08:00:00</option>
                              <option value="09:00:00">09:00:00</option>
                              <option value="11:00:00">11:00:00</option>
                              <option value="14:00:00">14:00:00</option>
                              <option value="15:00:00">15:00:00</option>

                         </select>

                         <label for="End">End :</label>
                         <select id="end" name="end">
                              <option value="09:00:00">09:00:00</option>
                              <option value="11:00:00">11:00:00</option>
                              <option value="12:00:00">12:00:00</option>
                              <option value="16:00:00">16:00:00</option>
                              <option value="17:00:00">17:00:00</option>
                         </select>
                    </div>

                    <div style="display: inline-flex;">
                         <label for="teach">Teacher</label>
                         <select id="teach" name="teach">
                              <?php
                              while ($pr->fetch()) {

                                   echo "<option value= " . $teach_name . ">"  . $teach_name . "</option>";
                              }
                              ?>

                         </select>

                         <label for="module">Module</label>
                         <select id="module" name="module">
                              <?php
                              while ($pr1->fetch()) {

                                   echo "<option value= " . $mod_name . ">"  . $mod_name . "</option>";
                              }
                              ?>

                         </select>
                    </div>

                    <div style="display: inline-flex;">
                         <label for="salle">Salle</label>
                         <select id="salle" name="salle">
                              <?php
                              while ($pr2->fetch()) {

                                   echo "<option  value= " . $salle_name . ">"  . $salle_name . "</option>";
                              }
                              ?>
                         </select>
                         <label for="salle"></label>
                    </div>

                    <button type="button" name="button" onclick="add()">ADD</button>
               </form>

          </div>
          <div id="middle">
               <div class="center">
                    <h1 id="text"></h1>
                    <table id="table"></table>
               </div>
          </div>
     </div>

     <script>
          function clear() {
               document.getElementById("day").value = '';
               document.getElementById("module").value = '';
               document.getElementById("salle").value = '';
               document.getElementById("teach").value = '';
               debut = document.getElementById("start").value = '';
               document.getElementById("end").value = '';
          }


          function add() {

               let select = document.getElementById("day");
               let day = select.options[select.selectedIndex].value;
               select = document.getElementById("module");
               let module = select.options[select.selectedIndex].value;
               select = document.getElementById("salle");
               let salle = select.options[select.selectedIndex].value;
               select = document.getElementById("teach");
               let teach = select.options[select.selectedIndex].value;
               let start = document.getElementById("start").value;
               let end = document.getElementById("end").value;

               console.log('=======================================================================================');
               console.log(`day=${day}, module=${module}, salle=${salle}, teacher=${teach}, start=${start}, end=${end}`);
               console.log('=======================================================================================');

               let xmlhttpReq = new XMLHttpRequest();
               xmlhttpReq.onreadystatechange = function() {
                    if (this.status == 200) {
                         loadFile();
                         clear();
                         document.getElementById("text").innerText = "Schedules display";
                    }
               };
               xmlhttpReq.open("GET", "addTimeTable.php?day=" + day + "&start=" + start + "&end=" + end + "&teach=" + teach +
                    "&module=" + module + "&salle=" + salle, false);
               xmlhttpReq.send();

          }


          function loadFile() {
               let xmlhttpReq = new XMLHttpRequest();
               xmlhttpReq.onreadystatechange = function() {
                    if (this.status == 200) {

                         displayFunc(this);
                    }
               };
               xmlhttpReq.open("GET", "question_2.xml", true);
               xmlhttpReq.send();
          }

          function displayFunc(xml) {
               let xmlFile = xml.responseXML;
               let table = `<tr>
                                        <th>Day</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Teacher</th>
                                        <th>Module</th>
                                        <th>Salle</th>
                                   </tr>`;

               let xmlData = xmlFile.getElementsByTagName('seance');


               for (let i = 0; i < xmlData.length; i++) {
                    table += "<tr><td>" +
                         xmlData[i].getAttribute("day") + "</td>";
                    table += "<td>" +
                         xmlData[i].getAttribute("start") + "</td>";
                    table += "<td>" +
                         xmlData[i].getAttribute("end") + "</td>";
                    table += "<td>" +
                         xmlData[i].getAttribute("teacher") + "</td>";
                    table += "<td>" +
                         xmlData[i].getAttribute("module") + "</td>";
                    table += "<td>" +
                         xmlData[i].getAttribute("salle") + "</td></tr>";

               }
               document.getElementById("table").innerHTML = table;

          }
     </script>
</body>


</html>