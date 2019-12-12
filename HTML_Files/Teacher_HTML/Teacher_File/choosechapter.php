<?php 
ob_start(); // needed this to solve a server problem with the header
session_start();
include_once '../../../classes/TeacherControls.php';
include_once '../../../classes/Quiz.php';

?>
<?php include_once 'inc/header.php';

if (isset($_GET['chapter'])) {
    $name = $_GET['chapter'];
    $_SESSION['chapter'] = $name;
}
//
if ($_GET) {
    $errors = array();
// validation 

    if (empty($_GET['chapter']) || !is_numeric($_GET['chapter'])) {
    
        $errors['name1'] = "Invalid entry, Please enter a Chapter";
      
    }



    if (count($errors) == 0) {

        header("Location: SearchHandler.php");
        return $_GET['chapter'];
        ob_end_flush();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head> 

<body>

    <form method="get" action="">
        choose chapter number:
        <input type="text" name="chapter" value=""> <br />
        <input type="submit" value="search">
        <p style='color:red';><?php if (isset($errors['name1'])) echo $errors['name1']; ?></p>
        

    </form>


    <div class="footer">
        <p style="color:white;">&copy; <?php echo date("Y");?> QueryHill.com</p>
        <!--
        <p>&copy;<?//php echo date("Y");?>
                Student Quiz Application -  A project created by Alex Maddox, Prachi Khare, Rachel Perry, Edri Torres and Matthew Wright.
        </p>
        -->
    </div>

</body>



</html>