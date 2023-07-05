<?php include("db.php")?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>


  <!-- Welcome header -->
  <h1 class="text-3xl font-bold underline text-center">
    Logs
  </h1>

    <!-- Table for storing all logs -->
    <table class="mx-auto text-center">
        <form method="POST" id="search_log" action="logs.php"></form> 
        <thead>
            <th class="border">Date</th>
            <th class="border">Author</th> 
            <th class="border" colspan="3">Action</th>
            <th class="border"><input type="text" name="searchtxt" placeholder="Search" form="search_log"/></th>
            <th class="border"><input type="submit" value="Search" name="search" form="search_log"/></th>
        </thead>

        <!-- Printing out all logs -->
        <?php 

            #if statement for an event when user decided to search for specific logs
            if(isset($_POST["search"])){

                try{
                    $search = $_POST['searchtxt'];
                    $stmt = $conn->prepare("SELECT * FROM logs WHERE logs_action like '%$search%'");

                    $stmt -> execute();
        
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                    foreach($rows as $row){
                        echo '<tr>';
                        echo '<td class="border">'.$row['logs_date'].'</td>';            
                        echo '<td class="border">'.$row['logs_author'].'</td>';
                        echo '<td class="border">'.$row['logs_action'].'</td>';
                        echo '</tr>';
                    }
                }catch(PDOException $e){
                    echo $e;
                }
                

            #otherwise prints all logs
            }else{
                $stmt = $conn->prepare("SELECT * FROM logs");
                $stmt -> execute();
    
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                foreach($rows as $row){
                    echo '<tr>';
                    echo '<td class="border">'.$row['logs_date'].'</td>';            
                    echo '<td class="border">'.$row['logs_author'].'</td>';
                    echo '<td class="border">'.$row['logs_action'].'</td>';
                    echo '</tr>';
                }
            }


        
        ?>
    

    </table>
    <a href="food.php">Go back</a>


</body>
</html>