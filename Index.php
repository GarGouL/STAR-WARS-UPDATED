<?php include 'Class.php' ?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TESTING</title>
</head>
<body>
<form method="post" action="">
    <div class="form-group">
        <label for="usr">Sök:</label>
        <input type="text" class="form-control" name="searchfield"/></p>
    	<p><input type="submit" class="btn btn-success" name="search" value="Sök" /></p>
      	<p><input type="submit" class="btn btn-info" name="showFile" value="Visa från fil" /></p>
      	<p><input type="submit" class="btn btn-primary" name="showAPI" value="Visa från API" /></p>
    </div>
</form>
<h1>Star Wars Database</h1>

<?php

    function search($searchValue)
    {
            $file = file_get_contents("https://swapi.co/api/films/");
            $data = json_decode($file);
            $content = $data->results;
        
        

        foreach($content as $item){
            
            $title = $item->title;
            $director = $item->director;
            $description = $item->opening_crawl;
            $description =  mb_strimwidth($description, 0, 80,"...");
                if($title == $searchValue){
            
                    $FilmSummary = new FilmSummary($title, $director, $description);
                    
                    echo $FilmSummary->getTitle();
                
                
                }   
        }
    }       
            
            
if(isset($_POST["search"]))
{
    $_SESSION['searchValue'] = $_POST['searchfield'];
    search($_POST['searchfield']); 
}  
    
?>
</body>
</html>