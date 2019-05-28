<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = yes">
    <link rel="stylesheet" href="mystyles.css">
    
    <script>
        
         // Print a summary of the seats that have been selected. This code was adapted from an example on W3schools.com.
        
        function printSummary() {
            var seats = document.getElementsByClassName('seat'); // Use the class name of checkbox to get the data.
            var selectedSeats = "";
            var totalPrice = 0;     
            
            for (var i=0; i < seats.length; i++) {
                
                // Check if each seat has been checked and if so add the value to a string.
               if (seats[i].checked) {
                    selectedSeats += seats[i].name + " - £" + seats[i].value + "\n";
                    totalPrice += parseFloat(seats[i].value);
               }
               
            }
          
             alert("Here are your selected seats: \n" + selectedSeats +     
                  "\n Total price = £" + parseFloat(totalPrice).toFixed(2));    // Print the contents of the selectedSeats string
            
        }
        
        // Iterate through the array of checkboxes and check that at least one seat has been selected.
        function isSeatSelected() {
            var seats = document.getElementsByClassName('seat');
          
            for (var i=0; i < seats.length; i++) {
                // If a seat has been selected, prompt user to confirm the booking.
                if (seats[i].checked) {
                    if (window.confirm("* Please confirm you wish to book! *")) {
                        return true;    
                    }
                    
                    else {
                        // The user doesn't wish to confirm, so don't proceed to book.php.
                        return false;
                    }
                }
            
            }
                // Notify user that no check box has been selected.
            alert("Please select a seat before booking!");
            return false;
            }
    
    </script>
    
</head>
<title>HAMLET'S THEATRE</title>    
    
    <body>
    
		<div id="mainContainer">
            
<!--        Load the images onto the page for the side borders.    -->
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
	
        <div id="innerContainer">
             
            <h1>HAMLET'S THEATRE</h1>   
            
            
            <div id="home">
                <input type='button' onclick="location.href = 'index.php';" value="Home Page" />
            </div> 
            
            <?php
            // Call the database. This code was provided by Laura Bocci in Semester 1, Week 8 2018.
            require('connect.php');
            $conn = myConnect();
            
            $title = $_GET['Title'];            // Extract the selected show Title that was passed from the form in the previous page.
            $price = $_GET['BasicTicketPrice']; // Extract the Ticket Price of the selected show that was passed from the form in the previous page.
            $date = $_GET['PerfDate'];          // Extract the PerfDate
            $time = $_GET['PerfTime'];          // Extract the PerfTime
        
            echo "<h2>Available seats for ". $title . " - ". $time ." - " . $date ."</h2>"; // Display the selected show info
            try {
                
                $sql = "SELECT Seat.RowNumber, Zone.PriceMultiplier
                                FROM Seat, Zone 
                                WHERE Zone.Name = Seat.Zone 
                                AND Seat.RowNumber NOT IN 
                                (SELECT Booking.RowNumber FROM Booking 
                                WHERE Booking.PerfTime = :time 
                                AND Booking.PerfDate = :date) ORDER BY Seat.RowNumber;";
                
                $handle = $conn->prepare($sql);
                $handle->execute(array(":time" => $time, ":date" => $date));
                $conn = null;

                $res = $handle->fetchAll();
                
                // Populate the table with the seats and prices for the show, pulled from the database.
                echo "<br>";
                echo "<form action='book.php' method='post' onSubmit='return isSeatSelected()'>";
                echo "<div class='buttons'>";
                    echo "<input id='check' type='button' onclick='printSummary()' value='      check      ' />"; 
                    echo "<input type='submit' value='      Book      '/>";
                echo "</div>";
                echo "<div id='email'>";
                echo "<label>Enter email: ";
                    echo "<input type='email' name='email' size='30' maxlength='100'required/>";
                echo "</label>";
                echo "</div>";
                
                echo "<br><br>";?>
                <input name="Title" type="hidden" value="<?php echo $title; ?>" />       <!-- Pass the selected Title of the show to book.php -->
                <input name="PerfDate" type="hidden" value="<?php echo $date; ?>"/>     <!-- Pass the selected Performance Date of the show to book.php -->
                <input name="PerfTime" type="hidden" value="<?php echo $time; ?>"/>     <!-- Pass the selected Performance Time of the show to book.php -->
                <input name="BasicTicketPrice" type="hidden" value="<?php echo $price; ?>"/>    <!-- Pass the Basic Ticket Price of the selected show to book.php -->
            
                <?php   
                
                
                $size = round(sizeof($res)/56);  // Calculate how many columns will be needed for the table
                
                echo "<font size='2'><table border=1 align=center>";
                
                
                // Dynamically build the table based on the number of seats
               
                if ($size <= 1) {
                echo "<th>Seat</th><th>Price</th><th>*</th>";
                    }
                elseif ($size > 1 && $size <= 2) {
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                }
                elseif ($size >2 && $size <= 3) {  
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                }
                elseif ($size > 3 && $size <= 4) {
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                }
                elseif ($size > 4 && $size <= 5) {
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                }
                elseif ($size > 5 && $size <= 6) {
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                }
                elseif ($size > 6 && $size <= 7) {
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";  
                }
                elseif ($size > 7 && $size <= 8) {
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>"; 
                }
                elseif ($size > 8 && $size <= 9) {
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>";
                    echo "<th>Seat</th><th>Price</th><th>*</th>"; 
                }
                
                echo "<tr>";
                
                
                $newLine = 0;
                foreach($res as $row) {
                    $seatPrice = number_format($row['PriceMultiplier']*$price,2); // Calculate the seat price using the Basic Ticket Price and the multiplier from the database.
                    
                    if ($newLine >= $size) {
                        echo "<tr>";
                        $newLine = 0;
                        }
                    echo "<td>".$row['RowNumber']."</td>";
                    echo "<td>£".$seatPrice.str_repeat("&nbsp",3)."</td>"; ?>
            
            
                    <td>
                        <!-- Use the name of the checkbox to pass the seat number and the value of the checkbox to pass the calculated seat price to book.php -->
                        <input class='seat' type="checkbox" name="<?php echo $row['RowNumber']; ?>" value="<?php echo $seatPrice; ?> " /> 
                    </td>
                   
                    <?php
                    echo "</form>";
                    $newLine ++;
                }
                
                
                 echo "</table></font>";
                
                  
            }   catch (PDOException $e) {
                    echo $e->getMessage();
                }

            ?>
                
            </div>
            <div id="footer">
                <p> This website was created by Wesley White 2018</p>
            </div>
        </div>
    </body>
    </html>
    