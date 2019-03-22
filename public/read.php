<?php 


if (isset($_POST['search'])) {
	
    require "../config.php"; 
    
    try {
    
    $connection = new PDO($dsn, $username, $password, $options);
    
    $search = $_POST['search'];
    
    $searchresults = "SELECT * FROM stories WHERE storyname LIKE '%$search%' OR storyuniverse LIKE '%$search%' OR storytype LIKE '%$search%' OR storygenre LIKE '%$search%' OR booknumber LIKE '%$search%' OR wip LIKE '%$search%' OR about LIKE '%$search%' OR  mainrelationship LIKE '%$search%' OR maincharacter LIKE '%$search%' OR stage LIKE '%$search%'";
    
        $statement = $connection->prepare($searchresults);
        $statement->execute();
        
        $result = $statement->fetchAll();
    } 
    
    catch(PDOException $error) {
		echo $searchresults . "<br>" . $error->getMessage();
	}
   
	}
    
    else {
        if (isset($_POST['view'])) {
        require "../config.php";
        
       try {
    
        $connection = new PDO($dsn, $username, $password, $options);
       
            $sql = "SELECT * FROM stories";
    
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        $result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
        
    } 
        }

    
if (isset($_GET["id"])) {
    require "../config.php";
    require "common.php";  
    
      try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $id = $_GET["id"];
		
        $sql = "DELETE FROM stories WHERE id = :id";
        
        $statement = $connection->prepare($sql);
        
        $statement->bindValue(':id', $id);
        
        $statement->execute();
         
        $success = "Work successfully deleted";
          
          echo $success;
        
	} catch(PDOException $error) {
        
		echo $sql . "<br>" . $error->getMessage();
	}	
     
    
    
}

?>


<?php include "templates/header.php"; ?>

<form method="post">

   
    <input type="text" name="search" placeholder="Search your stories">
    <input type="submit" name="submit" value="Search"> 
    <input type="submit" name="view" value="View all"> <br>
    

</form>

<?php  
 
    
       if ($result && $statement->rowCount() > 0) { 

?>
<h2>Results</h2>





<?php 
        
                foreach($result as $row) { 
            ?>

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
else {
    echo "You have no results";
}
    
?>



<?php include "templates/footer.php"; ?>
