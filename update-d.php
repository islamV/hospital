<?php
include 'conn-db.php';
session_start();
$table = $_GET['table'];
$ID = $_GET['ID'];
$page = $_GET['page'];
$sql = "SELECT * FROM `$table` WHERE `ID` = :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID', $ID);
$stmt->execute();
$row = $stmt->fetch();
if (isset($_POST['submit'])) {
    include 'conn-db.php';
    $name = $_POST['name'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];
    $department = $_POST['department'];
    $hire_date = $_POST['hire_date'];
    $errors = [];
    if (empty($errors)) {
        $sql = "UPDATE `$table` SET `name` = :name, `Age` = :age, salary =:salary,`department` = :department, `hire_date` = :hire_date, `Doctor_Name` WHERE `$table`.`ID` = :ID";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':hire_date', $hire_date);
        $stmt->bindParam(':ID', $ID);
        $stmt->execute();
        
        header('Location:patients-data.php?table='.$table);
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>UPDATE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="update.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= $page ?>" ?table=<?= $table ?>&ID=<?= $ID ?>">ALL data</a></li>
            </ul>
        </nav>
    </header>
    <center>
        <div class="main">
            <form method="POST" action="update.php?table=<?= $table ?>&ID=<?= $ID ?>&page=<?= $page ?>">
                <input type="hidden" name="table" value="<? $table ?>">
                <input type="hidden" name="ID" value="<?= $row['ID'] ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?= $row['name'] ?>">
                <label for="Age">Age:</label>
                <input type="number" name="age" value="<?= $row['Age'] ?>">
                <label for="salary">Salary:</label>
                <input type="number" name="age" value="<?= $row['salary'] ?>">
                <label>Department</label>
                <select name="department" required>
                    <option value="Pediatric diseases"> Pediatric diseases </option>
                    <option value="heart disease">heart disease</option>
                    <option value="bones disease">bones disease</option>
                    <option value="Obstetrics and gynecology">Obstetrics and gynecology</option>
                </select>
                <label for="entry_date">Entry of Date:</label>
                <input type="text" name="entry_date" value="<?= $row['hire_date'] ?>">
                <input type="submit" name="submit" value="update">
                <br>
            </form>
        </div>
    </center>
</body>

</html>