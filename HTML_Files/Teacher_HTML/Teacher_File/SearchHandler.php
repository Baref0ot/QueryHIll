<?php
session_start();

include_once'../../../classes/TeacherControls.php';
include_once'../../../classes/Quiz.php';

include_once 'inc/header.php';
$_SESSION['chapter'];
$chapid = $_SESSION['chapter'];
echo $chapid;
?>
<head></head>
<form method="post" action="choosechapter.php">
 <input type="submit" value="Go Back">

</form>

<form method="post" action="viewquiz.php">
     
     <input type="submit" value="Edit Quiz">
        

</form>

<!-- view part !-->
<?php 

$showChapter = new Quiz();

   if (isset($chapid)){
      // echo $_SESSION['chapter'];
$qid =$showChapter->setCatid($chapid);
$chapterid = $showChapter->findBychapterid($qid);
$validationmessage = $showChapter->ChapterValidation($qid);
          
    }
?>

<!DOCTYPE html>
<html>

<body>

<?php

if ($chapterid){
    
  ?>  
    <table align="center" border = "1px" style = "width:100px; line-height:20px; " >
        <tr colspan="12"></tr>
        <tr>
            <th> Question Id </th>
            <th> question</th>
            <th> ans1 </th>
            <th> ans2 </th>
            <th> ans3 </th>
            <th> ans4 </th>
            <th> correctanswer </th>
            <th> chapterid </th>
        
        
        </tr>
  <?php  
for ($x = 0;$x < count($chapterid) ;$x++){
 ?>   
<tr>
    <td><?php echo $chapterid[$x]['questionid']; ?></td>
    <td> <?php echo  $chapterid[$x]['question']; ?></td>
    <td> <?php echo ($chapterid[$x]['ans1']); ?></td>
    <td><?php echo ($chapterid[$x]['ans2']); ?></td>
    <td> <?php echo  ($chapterid[$x]['ans3']); ?></td>
    <td> <?php echo ($chapterid[$x]['ans4']); ?></td>
    <td> <?php echo ($chapterid[$x]['correctanswer']); ?></td>
    <td> <?php echo $chapterid[$x]['chapterid']; ?></td>
</tr>


<?php
   
}

 
   
      
//exit;
} 

?>
      <p style='color:red;'><?php
 if (isset($validationmessage)){
 	echo $validationmessage;
 }
        ?>   </p>
</table> 
<!-- end of view part!-->
    
<div class="footerSearchHandler">
		<h2> Created by team "Challengers"</h2>
	</div>
    </body>
    </html>