<?php 

// Read code
// Code to execute if search is performed
if (isset($_POST['search'])) {
	
    // Require config file with db variables
    require "config.php"; 
    
    try {
    
    // Connect to database
    $connection = new PDO($dsn, $username, $password, $options);
    
    // Define search
    $search = $_POST['search'];
    
    // Create the SQL statement
    $searchresults = "SELECT * FROM stories WHERE storyname LIKE '%$search%' OR storyuniverse LIKE '%$search%' OR storytype LIKE '%$search%' OR storygenre LIKE '%$search%' OR booknumber LIKE '%$search%' OR wip LIKE '%$search%' OR about LIKE '%$search%' OR  mainrelationship LIKE '%$search%' OR maincharacter LIKE '%$search%' OR stage LIKE '%$search%'";
    
        // Prepare and execute statement
        $statement = $connection->prepare($searchresults);
        $statement->execute();
        
        // Define statement as object, to show on page
        $result = $statement->fetchAll();
    } 
    
    // If it doesn't work, show the error
    catch(PDOException $error) {
		echo $searchresults . "<br>" . $error->getMessage();
	}
   
	}
    
    // Code to execute if view all is clicked
    else {
        if (isset($_POST['view'])) {

        // Require config file db variables
        require "config.php";
        
       try {
           
           // Connect to database
        $connection = new PDO($dsn, $username, $password, $options);
       
            // Create SQL 
            $sql = "SELECT * FROM stories";

        // Prepare and execute
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // Define as results object to display on page
        $result = $statement->fetchAll();

        // If it doesn't work, show the error
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
        
    } 
        }

    // Delete code
    // Code to run only if delete is clicked
if (isset($_GET["id"])) {

    // Require files
    require "config.php";
    require "common.php";  
    
      try {
          // Connect to db
        $connection = new PDO($dsn, $username, $password, $options);
        
        // Define id as variable 
        $id = $_GET["id"];
		
        // Create SQL
        $sql = "DELETE FROM stories WHERE id = :id";
        
        // Prepare SQL
        $statement = $connection->prepare($sql);
        
        // Bind id to PDO
        $statement->bindValue(':id', $id);
        
        // Execute statement
        $statement->execute();
         
         // Success
        $success = "Work successfully deleted";
          
          echo "<div class='container'> $success </div>";
    
        // If it doesn't work, show error
	} catch(PDOException $error) {
        
		echo $sql . "<br>" . $error->getMessage();
	}	
     
    
    
}

?>

<!-- Include the header -->
<?php include "templates/header.php"; ?>
<div class="container">

<!-- Search form and buttons -->
<form method="post">

   
    <input class="u-full-width" type="text" name="search" placeholder="Search your stories">
    <input type="submit" name="submit" value="Search"> 
    <input class="button-primary" type="submit" name="view" value="View all">  
    <a href='read.php'>Reset</a>  <br> 
    <!-- Reset link included for ease of returning to main page after delete is performed -->
    

</form>
</div>

<?php  
 
    // If there are results to show
       if ($result && $statement->rowCount() > 0) { 

?>

<div class="container">
<h2>Results</h2>


<?php 
        // Loop results for each table row
                foreach($result as $row) { 
            ?>

<!-- Display results as -->
<p>
    ID:
    <?php echo $row["id"]; ?><br> 
    Story Name:
    <?php echo $row['storyname']; ?><br>
    Story Universe:
    <?php echo $row["storyuniverse"]; ?><br> 
    Story Type:
    <?php echo $row['storytype']; ?><br> 
    Story Genre:
    <?php echo $row['storygenre']; ?><br> 
    Book Number:
    <?php echo $row["booknumber"]; ?><br> 
    WIP:
    <?php echo $row["wip"]; ?><br> 
    About:
    <?php echo $row['about']; ?><br> 
    Main Relationship:
    <?php echo $row["mainrelationship"]; ?><br> 
    Main Character:
    <?php echo $row["maincharacter"]; ?><br> 
    Stage:
    <?php echo $row["stage"]; ?><br> 
    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a>
    <a href='read.php?id=<?php echo $row['id']; ?>'>Delete</a>

</p>

<?php 
           
        ?>

<hr>
<?php }; 
           
        }

        // If nothing is clicked, show
else {
    
    echo "<div class='container'> You have no results</div>";
 
}

?>
</div>

<!-- Include footer -->
<?php include "templates/footer.php"; ?>

