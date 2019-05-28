<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = yes">
    <link rel="stylesheet" href="mystyles.css">
</head>
<title>HAMLET'S THEATRE</title>    
    
    <body>
        
        <div id="mainContainer">
            
<!--             import the advertisement images for the sides of the page-->
            
            <div id="leftsideImages">
                <img class="image1" src="images/Cats.jpg">
                <img class="image2" src="images/fame.jpeg">
                <img class="image3" src="images/Thriller.jpg">
                <img class="image4" src="images/billyelliot.jpeg">
                <img class="image5" src="images/lionking.jpeg">
            </div>
            
            <div id="rightsideImages">
                <img class="image1" src="images/snowwhite.png">
                <img class="image2" src="images/Tosca.jpg">
                <img class="image3" src="images/cinderella.png">   
                <img class="image4" src="images/lesmiserables.jpeg">   
                <img class="image5" src="images/mamma.jpeg">   
            </div>
            
        <div id="innerContainer">  <!-- The container for the header, table and description of the page-->
            
               
            <h1>HAMLET'S THEATRE</h1>   
           
             
            <!-- Some text describing the Theatre.-->
            <p id="opener"> *&nbsp; Welcome to Hamlet's Theatre &nbsp; * </p> <p> <br /> We are a traditional theatre established in 1970, and are proud to host the most entertaining and family friendly shows 
                    boasting past, present and future stars! We are also available for venue hire. <br />If you need to contact us for any reason please call 555-2342-3453  Thanks!</p>
            
            <!-- The table containing the data for the shows.-->
            <div id="tables">    
            <h2>Upcoming shows</h2>
            <?php
                            
            require('connect.php');   
            $conn = myConnect();            // Call myConnect() function in connect.php and get a PDO object.
            

            try {
                
                // Call the database. This code was provided by Laura Bocci in Semester 1, Week 8 2018.
                $sql = "SELECT * FROM Production";
                $handle = $conn->prepare($sql);
                $handle->execute();
                $conn = null;

                $res = $handle->fetchAll();
                
                echo "<br>";
                
                echo "<table border=1 align=center>";
                echo "<th>Title</th>";
                echo "<th>Tickets from</th>";
                
                foreach($res as $row) {
                        // Populate the table with the show data from database 
                    echo "<tr>";
                    echo "<form action='perf.php' method='get'>";     //Put all the data and buttons into a form, so that it can be submitted to another page. 
                    echo "<td>".$row['Title']."</td>";
                    echo "<td>"."£".$row['BasicTicketPrice'].str_repeat("&nbsp",3)."</td><td id='tableButton'><input type='submit' value='Show performances' /></td>";?>
                   
            
                <!--              
                    Store Title and BasicTicketPrice in the value field of inputs to be sent to perf.php when submitted. 
                    Code was adapted from https://stackoverflow.com/questions/4949847/hidden-field-in-php.
                -->
            
                    <input name="Title" type="hidden" value="<?php echo $row['Title']; ?>"/>
                    <input name="BasicTicketPrice" type="hidden" value="<?php echo $row['BasicTicketPrice']; ?>"/>
                   
                    <?php 
                    echo "</form>";
                  
                    
                }
                 echo "</table>";
                
            }   catch (PDOException $e) {
                    echo $e->getMessage();
                }

            ?>
               
              </div>
                
            </div>
            <div id="footer">
                <p> This website was created by Wesley White 2018</p>
            </div>
        </div>
            
    </body>
    </html>
    