<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Show The Timetable </title>
</head>
<link rel="stylesheet" href="../style/style.css">


<body>
     <?php
     $mysqli = new mysqli("localhost", "root", "sido", "time_managment");
     if ($mysqli->connect_error) {
          exit('You Cant Connect to this database..!');
     }
     $sql = "SELECT s.name, p.level, p.id 
                         FROM promotions p, specialities s 
                         WHERE s.id = p.spec_id";

     $pr = $mysqli->prepare($sql);
     $pr->execute();
     $pr->store_result();

     $pr->bind_result($name, $level, $id);
     ?>

     <div class="center">
          <form>
               <h1>Select a promotion</h1>
               <select id="select" name="select" onchange="selectValue(this.value)">
                    <option value=""></option>

                    <?php
                    while ($pr->fetch()) {
                         $promo = ($level) . ($name);

                         echo "<option value=" . $id . ">" . $promo . "</option>";
                    }
                    ?>
               </select>
          </form>
     </div>

     <br>

     <div class="center" id="timetable"></div>

     <script>
          function selectValue(val) {
               let xmlHttpRequest
               let nbr = parseInt(val)
               document.getElementById("timetable").innerHTML = nbr
               if (val = "") {
                    document.getElementById("timetable").innerHTML = ""
                    return
               }
               xmlHttpRequest = new XMLHttpRequest()
               xmlHttpRequest.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                         document.getElementById("timetable").innerHTML = this.responseText
                    }
               }
               xmlHttpRequest.open("GET", "timetable.php?promo_id=" + nbr, false)
               xmlHttpRequest.send()
          }
     </script>

</body>

</html>