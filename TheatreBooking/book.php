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
            
        <!-- import the advertisement images for the sides of the page -->
            
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
              
            
            <?php
            
            require('connect.php');
            $conn = myConnect();
            
            $title = $_POST['Title'];           // Extract the title passed from the previous page
            $date = $_POST['PerfDate'];         // Extract the Performance date of the show
            $time = $_POST['PerfTime'];         // Extract the Performance time of the show
            $email = $_POST['email'];           // Extract the email of the person booking the tickets
            $price = $_POST['BasicTicketPrice'];// Extract the Ticket Price of the selected show that was passed from the form in the previous page.
            $totalPrice = 0;
            $value = 0;
            
                // Display the summary
            echo "<h2>Thanks for your booking!!</h2>";        //  Display the confirmation message
            echo "<h3>".$email."&nbsp has booked seats for &nbsp".$title."&nbsp on &nbsp".$date. "&nbsp at &nbsp".$time. "</h3>";
           
            echo "<div id='summary'>";
                echo "Booking summary: ";
                echo "<br><br>";
            
            
            
            
            foreach ($_POST as $key => $value) {
                        // Extract only the seat number and the seat price from the POST data sent.
                if (($key !== 'Title') && ($key !== 'BasicTicketPrice') && ($key !== 'email') && ($key !== 'PerfDate') && ($key !== 'PerfTime')) {
                
                    $seat = $key;
                    $seatPrice = (float) $value;
                    $totalPrice += (float) $value;
                    echo "Seat&nbsp".$seat. "&nbsp - &nbsp£". number_format($seatPrice,2);
                    echo "<br>";
                    
                   // Call the database. This code was provided by Laura Bocci in Semester 1, Week 8 2018.
                    try {
                        // Insert the show info and customer email into the database. 
                    $handle = $conn->prepare("INSERT into Booking VALUES (:email, :date, :time, :seat);");
                    $handle->execute(array(":email" => $email, ":date" => $date, ":time" => $time, ":seat" => $seat));
                }   catch (PDOException $e) {
                        // If seat has already been booked (user may have pressed back button), alert user that they have booked the seats already
                echo "<script type='text/javascript'> alert('You have already booked seat $seat !');</script>"; 
               }
                }  
            }
                $conn = null;
                echo "<br>";
                echo "Total = £".number_format($totalPrice,2);    // Display the total price.
                echo "</div>";
                
            ?>
                <br />
                
                <div class='buttons'> 
                    <input type='button' onclick="location.href = 'index.php';" value="Select another performance" />
			    </div>
                
                <br />
                <h2>We hope you enjoy the Performance!</h2>
            <?php
               // Use the 'Title' to select the appropriate image to display
            
            echo "<br><br><br>";
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