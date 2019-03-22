<?php 

if(isset($_POST['submit'])) {

    require "../config.php"; 
    
    try {  
        $connection = new PDO($dsn, $username, $password, $options);
        
        
        $new_idea = array(  
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
        );
        
       
        $sql = "INSERT INTO stories (storyname, storyuniverse, storytype, storygenre, booknumber, wip, about, mainrelationship, maincharacter, stage) VALUES (:storyname, :storyuniverse, :storytype, :storygenre, :booknumber, :wip, :about, :mainrelationship, :maincharacter, :stage)"; 
        
       
        $statement = $connection->prepare($sql);
        $statement->execute($new_idea);
    
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        
    }
}
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>  
    <p>Story successfully added.</p>
<?php } ?>

<form method="post">

     <label for="storyname">Story Name</label>
    <input type="text" name="storyname" id="storyname"> <br>
    
    <label for="storyuniverse">Story Universe</label>
    <input type="text" name="storyuniverse" id="storyuniverse"> <br>
     
    <label for="storytype">Story Type</label>
    <select name="storytype" id="storytype">
        <option value="---"> ----- </option>
        <option value="Novel (series)"> Novel (series) </option>
        <option value="Novel"> Novel </option>
        <option value="Novella"> Novella </option>
        <option value="Short Story"> Short Story </option>
        <option value="Flash Fiction"> Flash Fiction </option>
        <option value="Long form/Episodic"> Long form/Episodic </option>
    </select> <br> 
    
    <label for="storygenre">Story Genre</label>
    <input type="text" name="storygenre" id="storygenre"> <br> 
    
    <label for="booknumber">Book Number</label>
    <input type="text" name="booknumber" id="booknumber"> <br>
    
    <label for="wip">Is this story a work in progress?</label>
    <select name="wip" id="wip">
        <option value="---">---</option>
        <option value="WIP">WIP</option>
    </select> <br>
    
    <label for="about">What's it about?</label>
    <input type="text" name="about" id="about"> <br>

    <label for="mainrelationship">Main Relationship</label>
    <select name="mainrelationship" id="mainrelationship">
        <option value="---"> ----- </option>
        <option value="Parental"> Parental </option>
        <option value="Family"> Family </option>
        <option value="Friends"> Friends </option>
        <option value="Romantic"> Romantic </option>
    </select> <br>

    <label for="maincharacter">Main Character</label>
    <input type="text" name="maincharacter" id="maincharacter"> <br>

    <label for="stage">Where are you up to?</label>
    <select name="stage" id="stage">
        <option value="none"> ----- </option>
        <option value="Still thinking"> Still thinking </option>
        <option value="Seriously planning"> Seriously planning </option>
        <option value="Drafting"> Drafting </option>
        <option value="Revising"> Revising </option>
        <option value="Finishing touches"> Finishing touches </option>
        <option value="Done"> Done </option>
        <option value="Scrapped"> Scrapped </option>
    </select> <br>

    
    <input type="submit" name="submit" value="submit"> 

</form>

<?php include "templates/footer.php"; ?>