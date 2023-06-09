<! --
Add task to module machine learning

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
  <a href="index.php" class="w3-bar-item w3-button nav-icons "> Dashboard</a>
  <a href="calendar.php" class="w3-bar-item w3-button nav-icons "> Calendar</a>
  <a href="studytrack.php" class="w3-bar-item w3-button nav-icons active"> Study Tracking</a>
  <a href="fitnesstrack.php" class="w3-bar-item w3-button nav-icons"> Fitness Tracking  </a>
</div>

<!-- Second sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:17%; margin-left: 250px;">
  <h3 class="w3-bar-item">Study Tracking</h3>
  <button class="w3-bar-item w3-button sector-heading active ">Study Diary</button>
  <div class="w3-bar-block sub-sector">
    <a href="webdev.php" class="w3-bar-item w3-button sub-subsector ">Web Development</a>
    <a href="ml.php" class="w3-bar-item w3-button sub-subsector active">Machine Learning</a>
    <button class="" onclick="removeModule()">x</button>
  </div>
  <button class="w3-bar-item w3-button w3-right" onclick="addSubSubSector()">+ Add Course</button>
  <br><br><br>
  <a href="mygrades.php" class="w3-bar-item w3-button sector-heading ">My Grades</a>  
  <a href="gradecalc.php" class="w3-bar-item w3-button sector-heading ">Grade Calculator</a>
</div>

<!-- Page Content -->
<div style="margin-left:34%">

<a href="portal.php" class="profile"> <?= $user['name'] ?></a>
<a href="logout.php" class="profile"> Logout</a>
<br>
<center>
  <h1>Machine Learning</h1> </center>
 


<div class="w3-container">
  <!-- Module tasks -->
  <div class="module-tasks">
    <h2>Tasks</h2>
    <button class="w3-button add-button" onclick="addTask()">+ Add Task</button>
    <br><br>
    <table class="w3-table-all">
      <thead>
        <tr class="w3-grey">
          <th>Task Name</th>
          <th>Task Description</th>
          <th>Due Date</th>
          <th>Status</th>
          <th>Priority</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="task-list2">
        <!-- Task rows will be added dynamically here -->
      </tbody>
    </table>
    <br>
    <button class="w3-button save-button" onclick="saveTasks()">Save</button>
  </div>
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

// Remove the module from the sidebar
function removeModule() {
  var module = document.querySelector(".sub-sector .active");
  module.parentNode.removeChild(module);
}
    // Save tasks to localStorage
function saveTasks() {
  var taskList = document.getElementById("task-list2");
  var tasks2 = [];

  // Loop through each row and save the task data
  for (var i = 0; i < taskList.rows.length; i++) {
    var task2 = {
      name: taskList.rows[i].cells[0].getElementsByTagName("input")[0].value,
      desc: taskList.rows[i].cells[1].getElementsByTagName("textarea")[0].value,
      date: taskList.rows[i].cells[2].getElementsByTagName("input")[0].value,
      status: taskList.rows[i].cells[3].getElementsByTagName("select")[0].value,
      priority: taskList.rows[i].cells[4].getElementsByTagName("select")[0].value
    };
    tasks2.push(task2);
    
  }
  
  // Store the task data in localStorage
  localStorage.setItem("tasks2", JSON.stringify(tasks2));
}

function addTask() {
  var taskList = document.getElementById("task-list2");
  var row = taskList.insertRow(-1);
  var nameCell = row.insertCell(0);
  var descCell = row.insertCell(1);
  var dueCell = row.insertCell(2);
  var statusCell = row.insertCell(3);
  var priorityCell = row.insertCell(4);
  var deleteCell = row.insertCell(5);

  nameCell.innerHTML = '<input type="text" class="w3-input" name="task-name">';
  descCell.innerHTML = '<textarea class="w3-input" name="task-desc"></textarea>';
  dueCell.innerHTML = '<input type="date" class="w3-input" name="task-due">';
  statusCell.innerHTML = '<select class="w3-select" name="task-status"><option value="not-started">Not Started</option><option value="in-progress">In Progress</option><option value="completed">Completed</option></select>';
  priorityCell.innerHTML = '<select class="w3-select" name="task-priority"><option value="low">Low</option><option value="medium">Medium</option><option value="high">High</option></select>';
  deleteCell.innerHTML = '<button class="w3-button delete-button" onclick="deleteTask(this)">Delete</button>';
  

  // Call saveTasks function after adding the new task
  saveTasks();
  
}


function deleteTask(button) {
  var row = button.parentNode.parentNode;
  var taskList = document.getElementById("task-list2");
  var tasks2 = [];

  // Loop through each row and save the task data to tasks array
  for (var i = 0; i < taskList.rows.length; i++) {
    if (taskList.rows[i] !== row) {
      var task2 = {
        name: taskList.rows[i].cells[0].getElementsByTagName("input")[0].value,
        desc: taskList.rows[i].cells[1].getElementsByTagName("textarea")[0].value,
        date: taskList.rows[i].cells[2].getElementsByTagName("input")[0].value,
        status: taskList.rows[i].cells[3].getElementsByTagName("select")[0].value,
        priority: taskList.rows[i].cells[4].getElementsByTagName("select")[0].value
      };
      tasks2.push(task2);
    }
  }

  // Clear the task list and re-add tasks
  taskList.innerHTML = "";
  for (var i = 0; i < tasks2.length; i++) {
    var task2 = tasks2[i];
    var newRow = taskList.insertRow(-1);
    var nameCell = newRow.insertCell(0);
    var descCell = newRow.insertCell(1);
    var dueCell = newRow.insertCell(2);
    var statusCell = newRow.insertCell(3);
    var priorityCell = newRow.insertCell(4);
    var deleteCell = newRow.insertCell(5);

    nameCell.innerHTML = '<input type="text" class="w3-input" name="task-name" value="' + task2.name + '">';
    descCell.innerHTML = '<textarea class="w3-input" name="task-desc">' + task2.desc + '</textarea>';
    dueCell.innerHTML = '<input type="date" class="w3-input" name="task-due" value="' + task2.date + '">';
    statusCell.innerHTML = '<select class="w3-select" name="task-status"><option value="not-started"' + (task2.status == "not-started" ? ' selected' : '') + '>Not Started</option><option value="in-progress"' + (task.status == "in-progress" ? ' selected' : '') + '>In Progress</option><option value="completed"' + (task.status == "completed" ? ' selected' : '') + '>Completed</option></select>';
    priorityCell.innerHTML = '<select class="w3-select" name="task-priority"><option value="low"' + (task2.priority == "low" ? ' selected' : '') + '>Low</option><option value="medium"' + (task.priority == "medium" ? ' selected' : '') + '>Medium</option><option value="high"' + (task.priority == "high" ? ' selected' : '') + '>High</option></select>';
    deleteCell.innerHTML = '<button class="w3-button delete-button" onclick="deleteTask(this)">Delete</button>';
  }

  // Call saveTasks function after removing the task
  saveTasks();
}


function removeTask(button) {
  var row = button.parentNode.parentNode;
  row.parentNode.removeChild(row);

  // Call saveTasks function after deleting the task
  saveTasks();
}


</script>

</body>
</html>