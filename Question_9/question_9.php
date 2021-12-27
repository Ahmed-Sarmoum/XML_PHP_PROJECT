<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../style/style.css">
     <title>Question 9</title>
</head>

<body class="center">
     <?php
     $mysqli = new mysqli("localhost", "root", "sido", "time_managment");
     if ($mysqli->connect_error) {
          exit('Connot talking with database :(');
     }
     $sql = "SELECT s.name, p.level, p.id
                         FROM specialities s, promotions p
                         WHERE s.id = p.spec_id";

     $pr = $mysqli->prepare($sql);
     $pr->execute();
     $pr->store_result();

     $pr->bind_result($spec_name, $level, $promo_id);
     ?>
     <div>
          <form>
               <div style="float: left">
                    <h1>Please Select Promotion</h1>
               </div>
               <div style="float: right;">
                    <select style="width: 100%; margin-top: 40px" id="select" name="select" onchange="selectItem(this.value)">
                         <option value=""></option>
                         <?php
                         while ($pr->fetch()) {
                              $prom = ($level) . ($spec_name);
                              echo "<option value=" . $promo_id . ">" . $prom . "</option>";
                         }
                         ?>
                    </select>
               </div>

          </form>
     </div>
     <div style="margin-top: 130px" id="student_table"></div>
     <script>
          function selectItem(item) {
               let xmlHttpReq
               let num = parseInt(item)
               document.getElementById("student_table").innerHTML = num

               if (item == "") {
                    document.getElementById("student_table").innerHTML = ""
                    return
               }
               xmlHttpReq = new XMLHttpRequest()
               xmlHttpReq.onreadystatechange = function() {
                    if (this.status == 200) {
                         document.getElementById("student_table").innerHTML = this.responseText
                    }
               }
               xmlHttpReq.open("GET", "studentData.php?promo_id=" + num, false)
               xmlHttpReq.send()
          }
     </script>
</body>

</html>