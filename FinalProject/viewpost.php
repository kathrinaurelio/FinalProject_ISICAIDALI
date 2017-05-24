<?php
// display the blog post chosen in previous page.
// also show comments box here
//
// This query will use a prepared statement, the record to be selected is based upon the id been passed from a $_GET['id'] request,
// as such a normally query is not recommended, a prepared statement is much better.
//The prepare will 'prepare' the database for query to be run then when $stmt->execute is ran the items
// from the array will be bound and sent to the database server, at no point does the two connect to there is no way to
// tamper with the database.
//
 $stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
 $stmt->execute(array(':postID' => $_GET['id']));
 $row = $stmt->fetch();

// If there is no postID coming from the database, their is no record so redirect the user to the index page.
//
 if($row['postID'] == ''){
     header('Location: ./');
     exit;
 }
// Lastly display the select post in full:
//
 echo '<div>';
     echo '<h1>'.$row['postTitle'].'</h1>';
     echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
     echo '<p>'.$row['postCont'].'</p>';
 echo '</div>';
//




 ?>
