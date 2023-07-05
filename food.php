<?php include("db.php"); session_start();?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>


  <!-- Welcome header -->
  <h1 class="text-3xl font-bold underline text-center">
    Welcome back <?php echo $_SESSION['user']?>
  </h1>

    <!-- Table for storing rows from database -->
    <table class="mx-auto text-center">

        <thead>
            <th class="border">Food name</th>
            <th class="border">Food description</th>
            <th class="border" colspan="3">Actions</th>
        </thead>

        <form method="POST" id="add_food" action="add.php"></form> 

        <tr>
            <td><input type="text" name="food_name" placeholder="Food name" form="add_food"/></td>
            <td><input type="text" name="food_desc" placeholder="Food desc" form="add_food"/></td>
            <td><input type="submit" name="addFood" value="ADD" form="add_food"/></td>
        </tr>

        <!-- Printing all rows from database -->
        <?php 
            $stmt = $conn->prepare("SELECT * FROM food");
            $stmt -> execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($rows as $row){
                echo '<tr>';
                echo '<td class="border">'.$row['food_name'].'</td>';            
                echo '<td class="border">'.$row['food_desc'].'</td>';
                echo '<td class="border"><a href="action.php?action=delete&id='.$row['id'].'">Delete</a></td>';
                echo '<td class="border"><a class="edit" style="cursor: pointer;" value="'.$row['id'].'">Edit</a></td>';
                echo '<td class="border"><a href="action.php?action=view&id='.$row['id'].'">View</a></td>';
                echo '</tr>';
            }
        
        ?>
    

    </table>

    <!-- Editing form -->
    <div id="editBox" class="hidden">

        <form method="POST" action="edit.php">
            
            <input id="food_id" type="text" name="food_id"/>
            <input type="text" name="food_name" placeholder="Food name"/>
            <input type="text" name="food_desc" placeholder="Food desc"/>
            <input type="submit" name="editFood" value="EDIT"/>

        </form> 

    </div>

    <!-- Navigation buttons -->
    <a href="logs.php">SEE LOGS</a>
    <br>
    <a href="logout.php">LOGOUT</a>

    <!-- jQuery script to display an editing form -->
<script>

$(document).ready(function(){
    $(".edit").click(function(){
        $("#editBox").removeClass("hidden");
        $("#food_id").val($(this).attr("value"));
    })
});


</script>


</body>
</html>