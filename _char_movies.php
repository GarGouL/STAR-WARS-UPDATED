<?php include 'Class.php' ?>
<?php

            $file = file_get_contents("https://swapi.co/api/films/");
            $data = json_decode($file);
            $content = $data->results;
        
        

        foreach($content as $item){
            
            $title = $item->title;
            $director = $item->director;
            $description = $item->opening_crawl;
            $description =  mb_strimwidth($description, 0, 80,"...");
                if($title == $_GET['charMovies']){
            
                    $FilmSummary = new FilmSummary($title, $director, $description);
                    
                    echo $FilmSummary->GetAllTitleInfo();
                
                
                }   
        }
?>