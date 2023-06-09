<! --
study diary page, need to select option from sidebar to go further

 --!>

<?php include '../control/conn.php' ?>

<!DOCTYPE html>
<html>
<title>Student Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../css/style.css">
<body>
<!-- First sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:17%">
  <h3 class="w3-bar-item"></h3>
  <a href="index.php" class="w3-bar-item w3-button nav-icons "> Dashbord</a>
  <a href="calendar.php" class="w3-bar-item w3-button nav-icons "> Calendar</a>
  <a href="studytrack.php" class="w3-bar-item w3-button nav-icons active"> Study Tracking</a>
  <a href="fitnesstrack.php" class="w3-bar-item w3-button nav-icons"> Fitness Tracking  </a>
</div>

<!-- Second sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:17%; margin-left: 250px;">
  <h3 class="w3-bar-item">Study Tracking</h3>
  <a href="studydiary.php" class="w3-bar-item w3-button sector-heading active ">Study Diary</a>
  <div class="w3-bar-block sub-sector">
    <a href="webdev.php" class="w3-bar-item w3-button sub-subsector">Web Development</a>

    
    <a href="ml.php" class="w3-bar-item w3-button sub-subsector">Machine Learning</a>
  </div>
   <button class="w3-bar-item w3-button w3-right" onclick="addSubSubSector()">+ Add Course</button>
   <br><br><br>
   <a href="mygrades.php" class="w3-bar-item w3-button sector-heading ">My Grades    </a>  
  <a href="gradecalc.php" class="w3-bar-item w3-button sector-heading ">Grade Calculator</a>
</div>
<!-- Page Content -->
<div style="margin-left:50%">
<a href="portal.php" class="profile"> <?= $user['name'] ?></a>
<a href="logout.php" class="profile"> Logout</a>
  <h1>Select Course</h1>
  
  
</div>
<div class="w3-container">

</div>
</div>
<script>
function addSubSubSector() {
  var activeSector = document.querySelector(".sector-heading.active");
  var newCourse = prompt("Enter the name of the course:");
  if (activeSector.nextElementSibling && activeSector.nextElementSibling.classList.contains("sub-sector")) {
    var subSector = activeSector.nextElementSibling;
    var newSubSubSector = document.createElement("a");
    newSubSubSector.className = "w3-bar-item w3-button sub-subsector";
    newSubSubSector.textContent = newCourse;

    // Create remove button
    var removeButton = document.createElement("button");
    removeButton.className = "";
    removeButton.textContent = "X";
    removeButton.onclick = function() {
      newSubSubSector.remove();
      removeButton.remove();
    }

    // Create div to contain sub-subsector and remove button
    var div = document.createElement("div");
    div.className = "w3-bar";

    // Append sub-subsector and remove button to div
    div.appendChild(newSubSubSector);
    div.appendChild(removeButton);

    // Append div to sub-sector
    subSector.appendChild(div);
  }
}



</script>

</body>
</html>