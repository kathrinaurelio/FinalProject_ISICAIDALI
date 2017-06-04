<?php //include config
require_once('../includes/config.php');


//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Post</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>

        <p><a href="./"><button class="w3-button w3-padding-large w3-white w3-border"><b>back to blog admin</b></button></a></p>
	<h2>Edit post</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postID ==''){
                    $error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
                    $error[] = 'Please enter the title.';
		}
                
                if ($_FILES['myfile']['size'] > 0 && $imageCaption === '') {
                    $error[] = 'Please enter an image caption';
                }

		if($postDesc ==''){
                    $error[] = 'Please enter the description.';
		}

		if($postCont ==''){
                    $error[] = 'Please enter the content.';
		}

		if(!isset($error)){

                    try {

                        //insert into database
                        $stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
                        $stmt->execute(array(
                                ':postTitle' => $postTitle,
                                ':postDesc' => $postDesc,
                                ':postCont' => $postCont,
                                ':postID' => $postID
                        ));
                        
                        if ($_FILES['myfile']['size'] > 0) {
                            
                            // delete existing blog_imgs row
                            $stmt2 = $db->prepare('DELETE FROM blog_imgs WHERE postID = :postID') ;
                            $stmt2->execute(array(
                                ':postID' => $postID
                            ));
                            
                            $info = pathinfo($_FILES['myfile']['name']);
                            $ext = $info['extension']; // get the extension of the file

                            // name the image "postId.extension"
                            $newname = $postID . '.' . $ext; 
                            $caption = $_POST['imageCaption'];

                            // save the image
                            $target = 'images/'.$newname;
                            move_uploaded_file($_FILES['myfile']['tmp_name'], $target);

                            // insert a record into the blog_imgs
                            $stmt3 = $db->prepare('INSERT INTO blog_imgs (caption, img, postID) VALUES (:caption, :img, :postId)');
                            $stmt3->execute(array(
                               ':caption' => $caption,
                               ':img' => $newname,
                               ':postId' => $postID
                            ));
                            
                        }

                        //redirect to index page
                        header('Location: index.php?action=updated');
                        exit;

                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 
                        
                        $stmt2 = $db->prepare('SELECT imgID, img, caption FROM blog_imgs WHERE postID = :postID') ;
			$stmt2->execute(array(':postID' => $_GET['id']));
			$rowImg = $stmt2->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post' enctype='multipart/form-data'>
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'</p>
                
                <p><label>Description</label><br />
		<input type='text' name='postDesc' value='<?php echo $row['postDesc'];?>'</p>
                
                <?php if ($rowImg && $rowImg['imgID']) { ?>
                <p>Current image:</p>
                <p><img src='images/<?php echo $rowImg['img'] ?>' style="width: 100px;" /></p>
                
                <p>Only select a new image below to overwrite the existing one</p>
                
                <?php } ?>
                
                <p><label>Image</label><br />
                <input type="file" name="myfile" /></p>
                
                <p><label>Image caption</label><br />
                <input type="text" name="imageCaption" value='<?php echo $rowImg['caption']; ?>' /></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html>	
