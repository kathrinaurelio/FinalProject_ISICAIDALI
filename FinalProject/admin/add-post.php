<!DOCTYPE html>
<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
    header('Location: login.php');
}
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add Post</title>
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
	<p><a href="./">Blog Admin Index</a></p>

	<h2>Add Post</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}
                
                if ($_FILES['myfile']['size'] === 0) {
                    $error[] = 'Please select an image';
                }
                
                if ($imageCaption === '') {
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
                        $stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)') ;
                        $stmt->execute(array(
                                ':postTitle' => $postTitle,
                                ':postDesc' => $postDesc,
                                ':postCont' => $postCont,
                                ':postDate' => date('Y-m-d H:i:s')
                        ));

                        // get last postID
                        $stmt2 = $db->prepare('SELECT postID FROM blog_posts ORDER BY postID DESC LIMIT 1');
                        $stmt2->execute();
                        $postId = $stmt2->fetch();

                        // get information on image
                        $info = pathinfo($_FILES['myfile']['name']);
                        $ext = $info['extension']; // get the extension of the file

                        // name the image "postId.extension"
                        $newname = $postId['postID'] . '.' . $ext; 
                        $caption = $_POST['imageCaption'];

                        // save the image
                        $target = 'images/'.$newname;
                        move_uploaded_file($_FILES['myfile']['tmp_name'], $target);

                        // insert a record into the blog_imgs
                        $stmt3 = $db->prepare('INSERT INTO blog_imgs (caption, img, postID) VALUES (:caption, :img, :postId)');
                        $stmt3->execute(array(
                           ':caption' => $caption,
                           ':img' => $newname,
                           ':postId' => $postId['postID']
                        ));

                        //redirect to index page
                        header('Location: index.php?action=added');
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

	<form action='' method='post' enctype='multipart/form-data'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>
                
                <p><label>Image</label><br />
                <input type="file" name="myfile" /></p>
                
                <p><label>Image caption</label><br />
                <input type="text" name="imageCaption" value='<?php if(isset($error)){ echo $_POST['imageCaption'];}?>' /></p>
                
		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>
                <p><input type='submit' name='submit' value='Submit'></p>

                   
        </form>
        

        

<?php
//If there has been any errors set then loop through the error array and display them.

if(isset($error)){
    foreach($error as $error){
        echo '<p class="error">'.$error.'</p>';
    }
}

?>

</div>
</body>
</html>
  

