<?php 

// Update
// Include config file for db varaibles
require "config.php";
require "common.php";

// If submit button is clicked
if (isset($_POST['submit'])){

    try {

        // Connect to database
        $connection = new PDO($dsn, $username, $password, $options);
        
        // Take elements from form and define as variable
        $story =[
            "id"                => $_POST['id'],
            "storyname"         => $_POST['storyname'],
            "storyuniverse"     => $_POST['storyuniverse'],
            "storytype"         => $_POST['storytype'],
            "storygenre"        => $_POST['storygenre'],
            "booknumber"        => $_POST['booknumber'], 
            "wip"               => $_POST['wip'],
            "about"             => $_POST['about'],
            "mainrelationship"  => $_POST['mainrelationship'],
            "maincharacter"     => $_POST['maincharacter'],
            "stage"             => $_POST['stage'],
          
        ];
        
        // Create SQL statement
        $sql = "UPDATE `stories`  
                SET id = :id,
                storyname = :storyname,
                storyuniverse = :storyuniverse,
                storytype = :storytype,
                storygenre = :storygenre,
                booknumber = :booknumber,
                wip = :wip,
                about = :about,
                mainrelationship = :mainrelationship,
                maincharacter = :maincharacter,
                stage = :stage

            WHERE id =:id";

        // Prepare and execute the statement
        $statement = $connection->prepare($sql);
        $statement->execute($story);
        
        // If not show error
    }   catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// Data from database
// Check id
if (isset($_GET['id'])) {
    
    try {
        // Connect to database
        $connection = new PDO($dsn, $username, $password, $options);
        
        // Define id as variable 
        $id = $_GET['id'];
        
        // Create SQL statement
        $sql = "SELECT * FROM stories WHERE id = :id";
        
        // Prepare statement
        $statement = $connection->prepare($sql);
        
        // Bind id to PDO
        $statement->bindValue(':id', $id);
        
        // Execute the statement
        $statement->execute();
        
        // Attach statement to new variable so can access it 
        $story = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Show error
    } catch(PDOException $error) { 
        echo $sql . "<br>" . $error->getMessage();
    }
    
?>

<?php
   
}   else {
       // No id? Show error
    echo "No id - something went wrong";
  
}
?>

<!-- Include header -->
<?php include "templates/header.php"; ?> 

<!-- Show if button was clicked and statement executed -->
<?php if (isset($_POST['submit']) && $statement) : ?>

    <div class="container">
        <p>Work successfully updated.</p>
    </div>

<?php endif; ?>

<!-- Html form -->
<div class="container">
    <h2>Edit a work</h2>

    <form method="post">
        
        <label for="id">ID</label>
        <input class="u-full-width" type="text" name="id" id="id" value="<?php echo escape($story['id']); ?>" > <br>

        <label for="storyname">Story Name</label>
        <input class="u-full-width" type="text" name="storyname" id="storyname" value="<?php echo escape($story['storyname']); ?>" > <br>
        
        <label for="storyuniverse">Story Universe</label>
        <input class="u-full-width" type="text" name="storyuniverse" id="storyuniverse" value="<?php echo escape($story['storyuniverse']); ?>" > <br>
        
        <label for="storytype">Story Type</label>
        <select class="u-full-width" name="storytype" id="storytype" value="<?php echo escape($story['storytype']); ?>" >
            <option value="---"> ----- </option>
            <option value="Novel (series)"> Novel (series) </option>
            <option value="Novel"> Novel </option>
            <option value="Novella"> Novella </option>
            <option value="Short Story"> Short Story </option>
            <option value="Flash Fiction"> Flash Fiction </option>
            <option value="Long form/Episodic"> Long form/Episodic </option>
        </select> <br> 
        
        <label for="storygenre">Story Genre</label>
        <input class="u-full-width" type="text" name="storygenre" id="storygenre" value="<?php echo escape($story['storygenre']); ?>" > <br> 
        
        <label for="booknumber">Book Number</label>
        <input class="u-full-width" type="text" name="booknumber" id="booknumber" value="<?php echo escape($story['booknumber']); ?>" > <br>
        
        <label for="wip">Is this story a work in progress?</label>
        <select class="u-full-width" name="wip" id="wip" value="<?php echo escape($story['wip']); ?>" >
            <option value="---">---</option>
            <option value="WIP">WIP</option>
        </select> <br>
        
        <label for="about">What's it about?</label>
        <input class="u-full-width" type="text" name="about" id="about" value="<?php echo escape($story['about']); ?>" > <br>

        <label for="mainrelationship">Main Relationship</label>
        <select class="u-full-width" name="mainrelationship" id="mainrelationship" value="<?php echo escape($story['mainrelationship']); ?>" >
            <option value="---"> ----- </option>
            <option value="Parental"> Parental </option>
            <option value="Family"> Family </option>
            <option value="Friends"> Friends </option>
            <option value="Romantic"> Romantic </option>
        </select> <br>

        <label for="maincharacter">Main Character</label>
        <input class="u-full-width" type="text" name="maincharacter" id="maincharacter" value="<?php echo escape($story['maincharacter']); ?>" > <br>

        <label for="stage">Where are you up to?</label>
        <select class="u-full-width" name="stage" id="stage" value="<?php echo escape($story['stage']); ?>" >
            <option value="none"> ----- </option>
            <option value="Still thinking"> Still thinking </option>
            <option value="Seriously planning"> Seriously planning </option>
            <option value="Drafting"> Drafting </option>
            <option value="Revising"> Revising </option>
            <option value="Finishing touches"> Finishing touches </option>
            <option value="Done"> Done </option>
            <option value="Scrapped"> Scrapped </option>
        </select> <br>
        
        <label for="date">Date</label>
        <input class="u-full-width" type="text" name="date" id="date" value="<?php echo escape($story['date']); ?>" > <br>
        
        <input class="button-primary" type="submit" name="submit" value="save"> 

    </form>
</div>

<!-- Include footer -->
<?php include "templates/footer.php"; ?> 