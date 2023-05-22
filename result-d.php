<?php
session_start();
include'conn-db.php';
$id = $_GET['id'];
$table = $_GET['table'];
$data = $_GET['data'];
$sql=$conn->prepare("SELECT *FROM $table WHERE `ID`=$id");
$sql->execute();
$row = $sql->fetch();
?>
</html>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="css/all.min.css">
<link rel="stylesheet" href="search.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">  

<meta charset="UTF-8">
  <title>نتائج البحث </title>

</head>
<body>
  <header>
  <Li><a href="<?=$data?>">search another</a></Li>
  </header>
  <center>
	 <div class="main">
     <h3>ID : <?php echo $row['ID'] ?></h3>
     <h3>name : <?php echo $row['name'] ?></h3>
     <h3>Age : <?php echo $row['Age'] ?></h3>
     <h3>Salary : <?php echo $row['salary'] ?></h3>
     <h3>Department : <?php echo $row['department'] ?></h3>
     <h3>Entry Date : <?php echo $row['hire_date'] ?></h3>
    <h2> </h2>
    <br><br>
    <br><br>
    </div>
		</center> 
   
</body>
</html>
