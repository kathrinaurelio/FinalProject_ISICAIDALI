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

                            $imgstmt = $db->prepare('SELECT img FROM blog_imgs WHERE postID = :postID');
                            $imgstmt->execute(array(':postID' => $row['postID']));
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
                <hr> 

                <!--   Labels / tags 
                  <div class="w3-card-2 w3-margin">
                    <div class="w3-container w3-padding">
                      <h4>Tags</h4>
                    </div>
                    <div class="w3-container w3-white">
                    <p><span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>
                      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>
                      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>
                      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>
                      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>
                    </p>
                    </div>
                  </div>-->

                <!-- END Introduction Menu -->
            </div>

            <!-- END GRID -->
        </div><br>

        <!-- END w3-content -->
    </div>
    
    <!-- Subscribe Modal -->
<!--<div id="subscribe" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content" style="padding:32px">
    <div class="w3-container w3-white">
      <i onclick="document.getElementById('subscribe').style.display='none'" class="fa fa-remove w3-transparent w3-button w3-xlarge w3-right"></i>
      <h2 class="w3-wide">SUBSCRIBE</h2>
      <p>Join my mailing list to receive updates on the latest blog posts and other things.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('subscribe').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>-->

    <!-- Footer -->
    <footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">

        
    </footer>

</body>
</html>
