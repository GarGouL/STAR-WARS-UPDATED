<?php include 'Class.php'?>
<?php session_start();
?>
<?php 
    
        
        $searchValue = $_SESSION['searchValue'];
        
        
        $file = file_get_contents("https://swapi.co/api/films/");
        $data = json_decode($file);
        $content = $data->results;
        
        
        
        

        foreach($content as $item){
            
            $title = $item->title;
            $director = $item->director;
            $description = $item->opening_crawl;
            $counter = -1;
            
            
            
             if($title == $searchValue){
                $FilmSummary = new FilmSummary($title, $director, $description);
                echo $FilmSummary->GetAllTitleInfo();
             
                foreach($item as $key => $value){
                    
                    if($key == "characters"){
                    
                        foreach($value as $values){
                            $counter++;
                        
                            $url = $value[$counter];
                            $char = new Character($url);
                        
                            echo '</br>'.$char->GetChar();
                        
                        }
                
                    }
                      
                    
                }     
            }
                
        }
              
    
  
        

  
     
?>