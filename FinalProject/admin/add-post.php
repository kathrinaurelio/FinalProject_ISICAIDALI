<!DOCTYPE html>

<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

?>

<!--//The form to add a post is made up of input's and textareas, each section 
//    has a name which will become a variable in php when the form is submitted.
//The forms also use what's called sticky forms meaning if validation fails then 
//    show all content entered into the form.-->


<form action='' method='post'>

    <p><label>Title</label><br />
    <input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

    <p><label>Description</label><br />
    <textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

    <p><label>Content</label><br />
    <textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

    <p><input type='submit' name='submit' value='Submit'></p>

</form>

<!--/*
For textarea's rather then making the admins enter the html for the text 
themselves its better to use an editor, I've chosen to use a popular one 
called <a href='http://www.tinymce.com'>TinyMCE</a> To use it you would 
normally have to download the files from tinyMCE's website upload them and 
configure the config, thankfully they have recently released a CDN version 
so you can include tinyMCE by simply referencing the CDN and then your setup options:
*
This will convert all textarea's into editors.
*/-->


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

<!--To process the form data once its been submitted is a simple process first make
sure the form has been submitted. Then remove any slashed in the $_POST array. 
Then extract all posts items inside $_POST by using extract($_POST) any post element 
is then accessible by using just its name so $_POST['postTitle'] becomes $postTitle.

Next validate the data, these are very basic validation rules. These can be 
improved upon, if any of the if statements are true then an error is needed, 
adding an error to an array called error is a simple way to collect multiple errors.-->

<?php

//<!--if form has been submitted process it-->
if(isset($_POST['submit'])){

    $_POST = array_map( 'stripslashes', $_POST );

    //collect form data
    extract($_POST);

    //very basic validation
    if($postTitle ==''){
        $error[] = 'Please enter the title.';
    }

    if($postDesc ==''){
        $error[] = 'Please enter the description.';
    }

    if($postCont ==''){
        $error[] = 'Please enter the content.';
    }
//<!--Next if no error has been set then insert the data into the database, 
//this is using prepared statements the place holders :postTitle, :postDesc
//etc are using to bind the matching array elements when execute to add the data
//into the correct columns. Once inserted the user is redirected back to the admin
//a action status is appended to the url ?action=added.-->

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

        //redirect to index page
        header('Location: index.php?action=added');
        exit;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

}

//<!--If there has been any errors set then loop through the error array and display them.-->

if(isset($error)){
    foreach($error as $error){
        echo '<p class="error">'.$error.'</p>';
    }
}
