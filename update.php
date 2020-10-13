<!DOCTYPE html> 
<html>  

<head> 
    <link rel="stylesheet" href="css/style.css"> 
</head> 

<body> 
<!-- CREATE EDIT BOX -->
<div class="container">
<?php function createEditBox($valueToUpdate,$keyToUpdate){ ?>
    <h1> UPDATE YOUR TASK HERE </h1>
    <?php  echo "YOUR OLD VALUE IS: " . $_POST['updateId']; ?>
    <div class="container">
    <div class="editBox">
    <form method="POST" action="update.php">
        <input class="input-field" type="text" name="editBox" id="editBox" placeholder="UPDATE YOUR TASK HERE" >
        <input type="hidden" name="valueToUpdate" value="<?php echo $valueToUpdate ?>">
        <input type="hidden" name="keyToUpdate" value="<?php echo $keyToUpdate ?>">
        <button class="edit button"  type="submit" name="edit" value="EDIT TODO"><i class="addIcon fa fa-check icon"></i> EDIT TODO</button>
    </form>
    </div>
    </div>  
<?php } ?>
</div>
<?php
if(isset($_POST['update'])){
   
    createEditBox($_POST['updateId'],$_POST['updateKey']);

} 
if(isset($_POST['edit'])){
    include_once('index.php');
    $valueToUpdate = $_POST['valueToUpdate'];
    $keyToUpdate =  $_POST['keyToUpdate'];
    $newToDo[$keyToUpdate] = $_POST['editBox'];

    $serializedArray = serialize($newToDo);
    $serializedArray = base64_encode($serializedArray);
    setcookie("newToDo", $serializedArray, time()+36000);

    header("Location: http://localhost/p2p4/session-cookies-practice/assignment-1_TO-DO-LIST/"); 
    createTable($newToDo);
}
 
?>
</body> 
</html> 