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
 require('includes/config.php'); 
 //include ('extras/socialbutton/socialbutton.html');

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt2 = $db->prepare('SELECT img FROM blog_imgs WHERE postID = :postID');

$stmt->execute(array(':postID' => $_GET['id']));

$stmt2->execute(array(':postID' => $_GET['id']));

$row = $stmt->fetch();
$row2 = $stmt2->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

		<h1>Blog</h1>
		<hr />
		<p><a href="./">Blog Index</a></p>


		<?php	
			echo '<div>';
				echo '<h1>'.$row['postTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
				echo '<p>'.$row['postCont'].'</p>';
                                echo '<p><img src="admin/images/'.$row2['img'].'" /></p>';
			echo '</div>';
		?>

	</div>

</body>
</html>