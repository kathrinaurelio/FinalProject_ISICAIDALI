<?php require('includes/config.php');
?>

<!DOCTYPE html>
<html>
    <title>Team blog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
        body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    </style>
    <body class="w3-light-grey">


        <!-- Header -->
        <header class="w3-container w3-center w3-padding-32"> 
            <h1><b>OUR BLOG</b></h1>
            <p>Welcome to our blog site, it's about <span class="w3-tag">OUR BLOG PROJECT</span></p>
        </header>

        <!-- Grid -->
        <div class="w3-row">  

        <!-- Blog entries -->
            <div class="w3-col l8 s12">
                
                 <?php
                    try {

                        $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');

                        while ($row = $stmt->fetch()) {
                            echo '<div class="w3-card-4 w3-margin w3-white">';
                            echo '<div class="w3-container">';

                            // prepare a statement which will run a little later
                            // use prepare because when the query is run, we need to give it some data
                            // in this case, when we run it, we need to replace ":postID" with the postID of the row
                            // we're currently on
                            $imgstmt = $db->prepare('SELECT img FROM blog_imgs WHERE postID = :postID');
                            
//                          // execute the query we prepared earlier, giving it an associative array.
                            // the associative array uses the same keys that were in the query (:postID, but could be anything :laura, :id etc)
                            $imgstmt->execute(array(':postID' => $row['postID']));
                            
                            // now, the query has been prepared, and the executed with the correct values (:postID)
                            // run the fetch() function on the query to fetch the results of the query into the variable $img
                            $img = $imgstmt->fetch();
                            
                            echo '<img src="admin/images/'. $img['img'] . '" style="width:100%"/>';
                            echo '<h3><b>'. $row['postTitle'] . ', <span class="w3-opacity">' . date('jS M Y', strtotime($row['postDate'])) . '</span></b></h3>';
                            echo '<h5>'. $row['postDesc'] . '</h5>';
                            
                                echo '<div class="w3-col m8 s12">';
                                echo'<p><a href="viewpost.php?id=' . $row['postID'] . '"><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></a></p>';
                                echo '</div>';
                               
                           echo '</div>';
                            
                echo '</div>';
                        }

                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                ?>


                <!-- END BLOG ENTRIES -->
                
            </div>
            <!-- Introduction menu -->
            <div class="w3-col l4">

                <!-- Our team -->
                <div class="w3-card-2 w3-margin w3-margin-top">
                    <img src="style/team.jpeg" style="width:100%">
                    <div class="w3-container w3-white">
                        <h4><b>This is our team</b></h4>
                        <p>Kathrin and Laura, exploring PHP together.</p>
                    </div>
                </div><hr>

                <!-- links -->
                <div class="w3-card-2 w3-margin">
                    <div class="w3-container w3-padding">
                        <h4>Useful info</h4>
                    </div>
                    <ul class="w3-ul w3-hoverable w3-white">
                        <li class="w3-padding-16">
                            <span class="w3-large">PHP</span><br>
                            <span>PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.</span>
                        </li>
                        <li class="w3-padding-16">
                            <span class="w3-large">Bootstrap</span><br>
                            <span>Bootstrap, a sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.</span>
                        </li> 
                        <li class="w3-padding-16">
                            <span class="w3-large">HTML</span><br>
                            <span>HTML (HyperText Markup Language) is the most basic building block of the Web. It describes and defines the content of a webpage.</span>
                        </li>  
                        <li class="w3-padding-16">
                             <span class="w3-large">CSS</span><br>
                             <span>CSS stands for Cascading Style Sheets. CSS describes how HTML elements are to be displayed on screen, paper, or in other media.</span>
                         </li>  

                        <li class="w3-padding-16 w3-hide-medium w3-hide-small">
                            <span class="w3-large">Scrum</span><br>
                            <span>Scrum is an iterative and incremental agile software development framework for managing product development.</span>
                        </li>  
                    </ul>
                    
                </div>
              <!-- END INTRO MENU -->    
            </div>
              <!-- END Grid --> 
        </div>


    

    <!-- Footer -->
    <footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">

        
    </footer>

</body>
</html>
