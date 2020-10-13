<!DOCTYPE html>
<html>

<head>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
$newToDo = [];
if (isset($_COOKIE["newToDo"])) {
    $cookiesArray = $_COOKIE["newToDo"];
    $cookiesArray = base64_decode($_COOKIE['newToDo']);
    $newToDo = unserialize($cookiesArray);
 
}
if (isset($_POST["submit"])) {
    array_push($newToDo,$_POST['newToDo']) ;

    $serializedArray = serialize($newToDo);
    $serializedArray = base64_encode($serializedArray);
    setcookie("newToDo", $serializedArray, time()+36000);
}
?>

<!-- TO DO LIST TABLE-->
<?php function createTable($array){?>  
<div class="container">
    <table class="main-table">
        <?php foreach($array as $key => $value){ ?>
            <tr>
                <td> <?php echo $value ?> </td>
                <td> 
                    <form method="POST" action="delete.php">
                        <button type="submit" name="delete" class="button delete">Delete<i class="fa fa-window-close icon"></i></button>
                        <input type="hidden" name="deleteId" value="<?php echo $value ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                    <form method="POST" action="update.php">
                        <button type="submit" name="update" class="button update">Update<i class="fa fa-edit icon"></i></button>
                        <input type="hidden" name="updateId" value="<?php echo $value ?>">
                        <input type="hidden" name="updateKey" value="<?php echo $key ?>">
                        <input type="hidden" name="update" value="true">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>    
<?php  }  ?>

<!-- TO DO LIST FORM-->
<form method="POST" name="ToDoList" id="ToDoList">   
    <div class="addToDoBar"> 
    <label>MY TO-DO LIST</label>
        <div class="input-icons"> 
            <input class="input-field" type="text" name="newToDo" placeholder="ADD TASK HERE">
            <button class="submit button"  type="submit" name="submit" value="ADD TODO"><i class="addIcon fa fa-plus-square icon"></i> ADD TO DO</button>
        </div> 
    </div>
</form>

<?php
if (!isset($_POST['delete']) and !isset($_POST['update']) and !isset($_POST['edit'])) {
    createTable($newToDo);
}
?>
</body>
</html>
