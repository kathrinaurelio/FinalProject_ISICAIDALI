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

//A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency
//Prepared statements basically work like this:
//Prepare: An SQL statement template is created and sent to the database. Certain values are left unspecified, called parameters (labeled "?"). Example: INSERT INTO MyGuests VALUES(?, ?, ?)
//The database parses, compiles, and performs query optimization on the SQL statement template, and stores the result without executing it
//
//Execute: At a later time, the application binds the values to the parameters, and the database executes the statement. The application may execute the statement as many times as it wants with different values
//
//Compared to executing SQL statements directly, prepared statements have three main advantages:
//Prepared statements reduces parsing time as the preparation on the query is done only once (although the statement is executed multiple times)
//Bound parameters minimize bandwidth to the server as you need send only the parameters each time, and not the whole query
//Prepared statements are very useful against SQL injections, because parameter values, which are transmitted later using a different protocol, need not be correctly escaped. If the original statement template is not derived from external input, SQL injection cannot occur.



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
<html>
    <title>Team blog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    
    <!--<style> <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></style>-->   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

    <style>
        body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    </style>
    <body class="w3-light-grey">


        <!-- Header -->
        <header class="w3-container w3-center w3-padding-32"> 
            <h1><b>OUR BLOG</b></h1>
            
        </header>
        <!-- return to index button link -->
        
<!--               <div class="w3-row">  -->
<!--       <div class="w3-card-4 w3-margin w3-white">-->
       <div class="w3-container">   
           
            <p><a href="./"><button class="w3-button w3-padding-large w3-white w3-border"><b>RETURN TO ALL BLOG POSTS</b></button></a></p>    
       </div>
       </div>
       </div>
           
 
        <!-- Grid -->
        <div class="w3-row">  
        <div class="w3-card-4 w3-margin w3-white">
       <div class="w3-container">     

            <?php
            echo '<div>';
            echo '<h1>' . $row['postTitle'] . '</h1>';
            echo '<p><i><span class="w3-opacity">Posted on ' . date('jS M Y', strtotime($row['postDate'])) . '</i></p>';
            
            if ($images['img']) {
                echo '<p><img src="admin/images/'.$images['img'].'" style="max-width: 560px;" /></p>';
            }
            
            echo '<p>' . $row['postCont'] . '</p>';
            echo '</div>';
            ?>
        </div>
        </div>
        
                    <!-- Grid -->
        <div class="w3-row">  
        <div class="w3-card-4 w3-margin w3-white">
       <div class="w3-container">  

	<h3>Add Comment</h3>

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
            </div>
            </div>
            
                    <!-- Grid -->
        <div class="w3-row">  
        <div class="w3-card-4 w3-margin w3-white">
       <div class="w3-container">  
           
        <?php
        
        if ($comments == TRUE){
            echo '<h3>Comments</h3>';

             foreach ($comments as $comment) {
                echo '<div>';
                echo '<p>' . $comment['commentAuthor'];
                echo '<i><span class="w3-opacity">, posted on ' . date('jS M Y', strtotime($comment['commentDate'])) . '</i></p>';
                echo '<p>' . $comment['commentCont'] . '</p>';
                echo '<p></br></p>';
                echo '</div>';
             }
            }
            ?>
            </div>
        </div>

        <!-- previous and next buttons -->
        <?php
            $stmt = $db->prepare('SELECT postID FROM blog_posts ORDER BY postID DESC');
            $stmt->execute();
            $result = $stmt->fetchAll();
            $prevPost = null;
            $nextPost = null;
            
            // loop through all results using an index
            for($i = 0; $i < count($result); ++$i){
                
                // if the IDs match, we've found the current post
                if ($result[$i]['postID'] === $_GET['id']) {
                    
                    // set $prevPost to $i - 1 (if we're greater than 0)
                    if ($i > 0) {
                        $prevPost = $result[$i - 1];
                    }
                    
                    // set $nextPost to $i + 1 (if we're not at the end)
                    if (($i + 1) < count($result)) {
                        $nextPost = $result[$i + 1];
                    }
                }
             }
            

            echo  '<div class="container">' ;             
            echo '<ul class="pager">';
            
            if ($prevPost && $prevPost['postID']) {
                echo  '<li class="previous"><a href="viewpost.php?id='. $prevPost['postID'] . '">Previous</a></li>';
            }
            
            if ($nextPost && $nextPost['postID']) {
                echo  '<li class="next"><a href="viewpost.php?id='. $nextPost['postID'] . '">Next</a></li>';
            }
            
            echo '</ul>';
            echo '</div>';
        ?>
    </body>
</html>