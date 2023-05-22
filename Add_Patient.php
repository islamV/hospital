<?php
include"conn-db.php";
$errors=[];
if (isset($_POST['submit'])) {;
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$doctor_name =$_POST['doctor_name'];
$doctor_id =$_POST['doctor_id'];
$department =$_POST['department'];
$entry_date =$_POST['entry_date'];
$errors =[];
  $stm = "SELECT `ID` FROM `patient` WHERE `ID` = :id";
  $q = $conn->prepare($stm);
  $q->bindValue(':id', $id);
  $q->execute();
  $data = $q->fetch();
  if ($data && !empty($id) && !empty($name) && !empty($age ) &&!empty($doctor_name)&&!empty($department) &&!empty($entry_date)&&!empty($doctor_id)) {
    $errors[] = "The patient is already there!";
    $_POST['id']='';
    $_POST['name']='';
    $_POST['age']='';
    $_POST['doctor_name']='';
    $_POST['doctor_id']='';
    $_POST['department']='';
    $_POST['entry_date']='';
  }
  else{
    $sql = "SELECT `ID` FROM `doctors` WHERE `ID`=:doctor_id";
    $row = $conn->prepare($sql);
    $row->bindValue(':doctor_id',$doctor_id );
    $row->execute();
    $d = $row->fetch(); 
  if (!$d && !empty($name) && !empty($age ) &&!empty($doctor_name)&&!empty($department) &&!empty($entry_date)) {
   $errors[]= "The doctor was not found";
   $_POST['id']='';
   $_POST['name']='';
   $_POST['age']='';
   $_POST['doctor_name']='';
   $_POST['doctor_id']='';
   $_POST['department']='';
   $_POST['entry_date']='';
  }
    }
if (empty($errors)) {
$sql =$conn->prepare("INSERT INTO `patient` (ID, name, Age,	department,entry_date,Doctor_Name,Doctor_ID	) VALUES (:id,:name, :age,:department,:entry_date, :doctor_name, :doctor_id)");
$sql->bindParam(':id',$id);
$sql->bindParam(':name',$name);
$sql->bindParam(':age',$age);
$sql->bindParam(':department',$department);
$sql->bindParam(':entry_date',$entry_date);
$sql->bindParam(':doctor_name',$doctor_name);
$sql->bindParam(':doctor_id',$doctor_id);
$sql->execute();
$_POST['id']='';
$_POST['name']='';
$_POST['age']='';
$_POST['Doctor_Name']='';
$_POST['department']='';
$_POST['entry_date']='';
header('location:patients-data.php?table=patient');
exit;
}
}

?>
<!DOCTYPE html>
<html>
<head>
  
<meta charset="utf-8">
  <title>اضافة مريض</title>

 <link rel="stylesheet" href="style.css">
 
</head>
<body>
  <header>
    <Nav>
      <ul>
  <li><a href="Patients-data.php" >Patients Data  </a></li>
  </ul>
  </Nav>
  </header>

  <h1> Add Patient </h1>
  
                  
  <form action="" method="POST">
<?php  if (isset($_POST['submit'])){ ?>
  <p class="error">
  <?php 
        if(isset($errors)){
            if(!empty($errors)){
                foreach($errors as $msg){
                    echo $msg . "<br>";
                }
            }
        }
    ?>
  </p>
<?php }?>
    <div>
      <label>ID :</label>  
      <input type="text" name="id" required>
    </div>
    <div>
      <label>Name:</label>
      <input type="text" name="name"required>
    </div>
    <div>
      <label> Age :</label>
      <input type="number" name="age"required> 
    </div>  
    <div>
      <label> Department </label>
      <select name="department"required>
      <option value="Pediatric diseases"> Pediatric diseases </option>
        <option value="heart disease">heart disease</option>
        <option value="bones disease">bones disease</option>
        <option value="Obstetrics and gynecology">Obstetrics and gynecology</option>
      </select>
    </div>
    <div>
      <label> Entry Date :</label>
      <input type="date" name="entry_date"required>
    </div>  
    <div>
      <label> Doctor Name :</label>
      <input type="text" name="doctor_name"required>
    </div>  
    <div>
      <label> Doctor ID :</label>
      <input type="text" name="doctor_id"required>
    </div>  
    <div>
    <button type="submit" name="submit"> ADD </button>
  </form>
</body>
</html>
