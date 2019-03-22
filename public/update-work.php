<?php 

require "../config.php";
require "common.php";

if (isset($_POST['submit'])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        
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


        $statement = $connection->prepare($sql);

        $statement->execute($story);
        
        
    }   catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


if (isset($_GET['id'])) {
    
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM stories WHERE id = :id";
        
        $statement = $connection->prepare($sql);
        
        $statement->bindValue(':id', $id);
        
        $statement->execute();
        
        $story = $statement->fetch(PDO::FETCH_ASSOC);
    
    } catch(PDOException $error) { 
        echo $sql . "<br>" . $error->getMessage();
    }
    
   
    echo $_GET['id'];
    
}   else {
       
    echo "No id - something went wrong";
  
}
?>

<?php include "templates/header.php"; ?> 

<?php if (isset($_POST['submit']) && $statement) : ?>
<p>Work successfully updated.</p>
<?php endif; ?>

<h2>Edit a work</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($story['id']); ?>" > <br>

     <label for="storyname">Story Name</label>
    <input type="text" name="storyname" id="storyname" value="<?php echo escape($story['storyname']); ?>" > <br>
    
    <label for="storyuniverse">Story Universe</label>
    <input type="text" name="storyuniverse" id="storyuniverse" value="<?php echo escape($story['storyuniverse']); ?>" > <br>
     
    <label for="storytype">Story Type</label>
    <select name="storytype" id="storytype" value="<?php echo escape($story['storytype']); ?>" >
        <option value="---"> ----- </option>
        <option value="Novel (series)"> Novel (series) </option>
        <option value="Novel"> Novel </option>
        <option value="Novella"> Novella </option>
        <option value="Short Story"> Short Story </option>
        <option value="Flash Fiction"> Flash Fiction </option>
        <option value="Long form/Episodic"> Long form/Episodic </option>
    </select> <br> 
    
    <label for="storygenre">Story Genre</label>
    <input type="text" name="storygenre" id="storygenre" value="<?php echo escape($story['storygenre']); ?>" > <br> 
    
    <label for="booknumber">Book Number</label>
    <input type="text" name="booknumber" id="booknumber" value="<?php echo escape($story['booknumber']); ?>" > <br>
    
    <label for="wip">Is this story a work in progress?</label>
    <select name="wip" id="wip" value="<?php echo escape($story['wip']); ?>" >
        <option value="---">---</option>
        <option value="WIP">WIP</option>
    </select> <br>
    
    <label for="about">What's it about?</label>
    <input type="text" name="about" id="about" value="<?php echo escape($story['about']); ?>" > <br>

    <label for="mainrelationship">Main Relationship</label>
    <select name="mainrelationship" id="mainrelationship" value="<?php echo escape($story['mainrelationship']); ?>" >
        <option value="---"> ----- </option>
        <option value="Parental"> Parental </option>
        <option value="Family"> Family </option>
        <option value="Friends"> Friends </option>
        <option value="Romantic"> Romantic </option>
    </select> <br>

    <label for="maincharacter">Main Character</label>
    <input type="text" name="maincharacter" id="maincharacter" value="<?php echo escape($story['maincharacter']); ?>" > <br>

    <label for="stage">Where are you up to?</label>
    <select name="stage" id="stage" value="<?php echo escape($story['stage']); ?>" >
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
    <input type="text" name="date" id="date" value="<?php echo escape($story['date']); ?>" > <br>
    
    <input type="submit" name="submit" value="save"> 

</form>


<?php include "templates/footer.php"; ?> 