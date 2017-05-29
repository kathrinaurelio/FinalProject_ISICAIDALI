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
$stmt2 = $db->prepare('SELECT commentID, commentAuthor, commentCont, commentDate, postID FROM blog_comments WHERE postID = :postID');
$stmt3 = $db->prepare('SELECT img FROM blog_imgs WHERE postID = :postID');

$stmt->execute(array(':postID' => $_GET['id']));
$stmt2->execute(array(':postID' => $_GET['id']));
$stmt3->execute(array(':postID' => $_GET['id']));

$row = $stmt->fetch();
$images = $stmt3->fetch();
$comments = $stmt2->fetchAll();

//if post does not exists redirect user.
if ($row['postID'] == '') {
    header('Location: ./');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Blog - <?php echo $row['postTitle']; ?></title>
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
            echo '<h1>' . $row['postTitle'] . '</h1>';
            echo '<p>Posted on ' . date('jS M Y', strtotime($row['postDate'])) . '</p>';
            echo '<p><img src="admin/images/'.$images['img'].'" /></p>';
            echo '<p>' . $row['postCont'] . '</p>';
            echo '</div>';
            ?>

        </div>
        <div id="wrapper">
            <h3>Comments</h3>
            <?php
             foreach ($comments as $comment) {
                echo '<div>';
                echo '<p>' . $comment['commentAuthor'] . '</p>';
                echo '<p>Posted on ' . date('jS M Y', strtotime($comment['commentDate'])) . '</p>';
                echo '<p>' . $comment['commentCont'] . '</p>';
                echo '<p></br></p>';
                echo '</div>';
            }
            ?>
        </div>
        
        <div id="wrapper">


	<h2>Add Comment</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($commentAuthor ==''){
			$error[] = 'Please enter your name.';
		}


		if($commentCont ==''){
			$error[] = 'Please enter your comment.';
		}

		if(!isset($error)){

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_comments (commentAuthor,commentCont,commentDate, postID) VALUES (:commentAuthor, :commentCont, :commentDate, :postID)') ;
				$stmt->execute(array(
					':commentAuthor' => $commentAuthor,
					':commentCont' => $commentCont,
					
					':commentDate' => date('Y-m-d H:i:s'),
                                        ':postID' => $_GET['id']
                                        
				));

				//refreshes page
                                http_response_code(303);
                                header("Location: ${_SERVER['REQUEST_URI']}");
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Author</label><br />
		<input type='text' name='commentAuthor' value='<?php if(isset($error)){ echo $_POST['commentAuthor'];}?>'></p>

		<p><label>Comment</label><br />
		<textarea name='commentCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['commentCont'];}?></textarea></p>

		<p><input type='submit' name='submit' value='Submit'></p>

	</form>

</div>
    </body>
</html>