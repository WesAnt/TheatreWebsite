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
            
<!--         import the advertisement images for the sides of the page-->
            
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
            
        <div id="innerContainer">   <!-- The container for the header, table and description of the page -->
            
               
            <h1>HAMLET'S THEATRE</h1>   
           
                 
            <div id="home">
                <input type='button' onclick="location.href = 'index.php';" value="Home Page" />
            </div>      
            <br />
            
            <?php
            // Call the database. This code was provided by Laura Bocci in Semester 1, Week 8 2018.
            require('connect.php');
            $conn = myConnect();
           
            $title = $_GET['Title'];            // Extract the selected Title of the show passed from the previous page
            $price = $_GET['BasicTicketPrice']; // Extract the selected Ticket Price of the show passed from the previous page
            
          
            echo "<h2>Timetable for ". " " .$title ." tickets from £" .$price. "</h2>";
                    
            try {
                
                $sql = "SELECT * FROM Performance WHERE Performance.Title = :title ORDER BY PerfDate, PerfTime";
                $handle = $conn->prepare($sql);
                $handle->execute(array(":title" => $title));
                $conn = null;

                $res = $handle->fetchAll();
                
                echo "<br><br><br>";
                
                 // Build the main structure of the table and set the border. Center the table on the page
                echo "<table border=1 align=center>";
                echo "<th>Title</th>";
                echo "<th>Date</th>";
                echo "<th>Time</th>";
                
                
                foreach($res as $row) {
                    // Populate the table with the data from the database
                    echo "<tr>";
                    echo "<form action='seats.php' method='get'>"; // Encapsulate the data and buttons into a form so that it can be passed to seat.php.
                    echo "<td>".$row['Title']."</td>";
                    echo "<td>".$row['PerfDate']."</td>";
                    echo "<td>".$row['PerfTime'].str_repeat("&nbsp",3)."</td><td id='tableButton'><input type='submit' value='Show availability' />"."</td>";?>
                    
                    <!-- The following hidden input code was adapted from https://stackoverflow.com/questions/4949847/hidden-field-in-php.-->
                    <input name="Title" type="hidden" value="<?php echo $title; ?>" />
                    <input name="BasicTicketPrice" type="hidden" value="<?php echo $price; ?>" />
                    <input name="PerfDate" type="hidden" value="<?php echo $row['PerfDate']; ?>"/>
                    <input name="PerfTime" type="hidden" value="<?php echo $row['PerfTime']; ?>"/>
                    
                    <?php 
                    echo "</form>";
                }
                 echo "</table>";
                
            }   catch (PDOException $e) {
                    echo $e->getMessage();
                }
            
                     // Use the 'Title' to select the appropriate image to display
                echo "<br>";
                echo "<div class='bodyImage'>";
                    switch ($title) {
                        case 'Cats':
                            echo "<img src='images/Cats.jpg'/>";      
                            break;
                        
                        case 'Fame': 
                            echo "<img src='images/fame.jpeg'/>";   
                            break;
                        
                        case 'Tosca': 
                            echo "<img src='images/Tosca.jpg'/>";
                            break;
                        
                        case 'Thriller':
                            echo "<img src='images/Thriller.jpg'/>";
                            break;
                        
                        case 'Snow White':
                            echo "<img src='images/snowwhite.png'/>";
                            break;
                        
                        case 'Lion King':
                            echo "<img src='images/lionking.jpeg'/>";
                            break;   
                        
                        case 'Wicked':
                            echo "<img src='images/wicked.jpeg'/>";
                            break;
                        
                        case 'Cinderella':
                            echo "<img src='images/cinderella.png'/>";
                            break;
                            
                        case 'Billy Elliot':
                            echo "<img src='images/billyelliot.jpeg'/>";
                            break;
                        
                        case 'Mamma Mia':
                            echo "<img src='images/mamma.jpeg'/>";
                            break;
                            
                        case 'Les Miserables':
                            echo "<img src='images/lesmiserables.jpeg'/>";
                            break;
                        
                    }
                echo "</div>";
            ?>
            
            </div>
            <div id="footer">
                <p> This website was created by Wesley White 2018</p>
            </div>
        </div>
    </body>
    </html>
    