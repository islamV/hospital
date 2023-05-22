<?php
include"conn-db.php";
$sql = "SELECT * FROM `doctors`";
$stmt = $conn->prepare($sql);  
$stmt->execute(); 
if (isset($_POST['search'])) {
  $id = $_POST['id'];
  $table ="doctors";
   $errors =[];
if (empty($id)) {
    $errors[] = "ID is required";
}else{
 $stm = "SELECT `ID` FROM `$table` WHERE `ID` = :id";
      $q = $conn->prepare($stm);
      $q->bindValue(':id', $id);
      $q->execute();
      $data = $q->fetch();
    
if (!$data) {
       $errors[]="لا يوجد نتائج بحث";
}
}
if(empty($errors)){
        header('Location:result-d.php?table='.$table .'&id='. $id .'&data=doctors-data.php');
        exit;
}
}  
if (isset($_POST['ID'])) {
  $ID = $_POST['ID'];
  $name = $_POST['name'];
  if (isset($_POST['delete'])) {
    $sql = "DELETE FROM `doctors` WHERE `ID` = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();
  } else if (isset($_POST['update'])) {
      header('Location: update-d.php?page=Doctors-data.php&table=doctors&ID='.$ID);
      exit;
  }
  header('Location: Doctors-data.php?');
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="show.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Doctors Data</title>
   
  </head>
 
  <body>
  <header>
      <nav>
        <ul>
        <li><a href="Main_Page.php" > Home </a></li>
    <li><a href="Add_Doctor.php" > Add Doctor </a></li>
        </ul>
    </nav>
    </header>
    <h1>Doctors Data</h1>
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
        <input type="text" name ="id" placeholder=" ID" >  
          <button class="btn btn-primary" type="submit" name=search>search</button> 
    </form>
    <table>
      <thead>
        <tr>
        <th>ID Number</th>
          <th>Name</th>
          <th> Age </th> 
           <th>Salary</th>
          <th>Department</th>        
          <th>Hire Date</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <?php
			while ($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>" . $row['ID'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['Age'] . "</td>";
				echo "<td>" . $row['salary'] . "</td>";
				echo "<td>" . $row['department'] . "</td>";
				echo "<td>" . $row['hire_date'] . "</td>";
       
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='ID' value='" . $row['ID'] . "'>";
        echo "<input type='hidden' name='name' value='" . $row['name'] . "'>";
        echo "<button class='btn btn-danger' type='submit' name='delete'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='ID' value='" . $row['ID'] . "'>";
        echo "<input type='hidden' name='name' value='" . $row['name'] . "'>";
        echo "<button  class='btn btn-primary'type='submit' name='update'>Update</button>";
        echo "</form>";
        echo "</td>";
         echo "</tr>";
			}
			?>
      
    </table>
  </body>
</html>