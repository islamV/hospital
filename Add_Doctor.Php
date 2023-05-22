<?php
include"conn-db.php";
if (isset($_POST['submit'])) {
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$salary =$_POST['salary'];
$department =$_POST['department'];
$hire_date =$_POST['hire_date'];
$errors =[];
  $stm = "SELECT `ID` FROM `doctors` WHERE `ID` = :id";
  $q = $conn->prepare($stm);
  $q->bindValue(':id', $id);
  $q->execute();
  $data = $q->fetch();
  if ($data) {
    $errors[] = "ID already exists";
  }
  if ($data && !empty($id) && !empty($name) && !empty($age ) &&!empty($doctor_name)&&!empty($department) &&!empty($entry_date)) {
    $errors[] = "The patient is already there!";
    $_POST['id']='';
    $_POST['name']='';
    $_POST['age']='';
    $_POST['salary']='';
    $_POST['department']='';
    $_POST['hire_date']='';
  }
if (empty($errors)) {
$sql =$conn->prepare("INSERT INTO `doctors` (ID, name,Age,salary,department,hire_date	) VALUES (:id,:name, :age, :salary,:department,:hire_date)");
$sql->bindParam(':id',$id);
$sql->bindParam(':name',$name);
$sql->bindParam(':age',$age);
$sql->bindParam(':salary',$salary);
$sql->bindParam(':department',$department);
$sql->bindParam(':hire_date',$hire_date);
$sql->execute();
$_POST['id']='';
$_POST['name']='';
$_POST['age']='';
$_POST['salary']='';
$_POST['department']='';
$_POST['hire_date']='';
header('location:Doctors-data.php?table=doctors');
exit;
}
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>إضافة دكتور</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
<header>
    <Nav>
      <ul>
  <li><a href="Doctors-data.php" > Doctors Data  </a></li>
  </ul>
  </Nav>
  </header>
  <h1>Add Doctors</h1>
  <form action="" method="POST"> 
  <?php if ((isset($_POST['submit']))) {?>
      
      <p class="error"> <?php echo $errors[0]?></p>
     <?php }?>
    <div>
      <label> ID : </label>
      <input type="number" name="id">
    </div>
    <div>
      <label> Name :</label>
      <input type="text" name="name">
    </div>  
   
    <div>
      <label> Age :</label>
      <input type="number" name="age"> 
    </div>  
    <div>
      <label> Salary :</label>
      <input type="number" name="salary">
    </div>
    
  <div>
    <label> Department </label>
    <select name="department">
    <option value="Pediatric diseases"> Pediatric diseases </option>
      <option value="heart disease">heart disease</option>
      <option value="bones disease">bones disease</option>
      <option value="Obstetrics and gynecology">Obstetrics and gynecology</option>
    </select>

  </div>
  <div>
      <label> Hire Date :</label>
      <input type="date" name="hire_date"required>
    </div> 
  <button type="submit" name="submit"> ADD </button>
  </form>
</body>
<style type="text/css">

  </style>
</html>