

<?php

class FilmSummary{
    public $title;
    public $director;
    public $description;
    
    function __construct($title, $director, $description){   
     
     $this->title = $title;
     $this->director = $director;
     $this->description = $description;
     
    }
        public function getTitle(){
            
            
            return "<a href='_movie.php'>$this->title</a>"."</br>".$this->director.
            "</br>".$this->description;

        } 
        
        public function GetAllTitleInfo(){
        
            return '<h2>'.$this->title."</h2>".
            "<strong>Director: "."</strong>".$this->director.
            "</br>".
            "<strong>Description: "."</strong>".$this->description.
            "</br>";
        }
        
}

Class Character{
    public $name;
    public $height;
    public $species;
    public $films;
    public $filmUrl;
    private static $number_of_char = 0;
    
    function __construct($url){  
        $file = file_get_contents($url);
        $data = json_decode($file);
        
        $name = $data->name;
        $mass = $data->mass;
        $height = $data->height;
        $gender = $data->gender;
        $species = $data->species;
        $films = $data->films;
        
        $this->name = $name;
        $this->mass = $mass;
        $this->height = $height;
        $this->gender = $gender;
        $this->species = $species;
        $this->films = $films;
        Character::$number_of_char++;
        
    }
        
    public function GetChar(){
              
        return "<strong>Character:  ".Character::$number_of_char."</strong>".'</br>'.
                "<a href='_character.php?charName={$this->name}'>{$this->name}</a>".'</br>';
               
           
    }
        
    public function GetCharDetails(){

        if($this->name == $_GET['charName']){
              
            
            $this->species = implode($this->species);
            $filespecies = file_get_contents($this->species);
            $dataspec = json_decode($filespecies);
            $specie = $dataspec->name;
            $this->specie = $specie;
            
            echo '</br>'."<h2>{$this->name}</h2>".
            "<strong>Weight: </strong>"."{$this->mass}"." kg".'</br>'.
            "<strong>Height: </strong>"."{$this->height}"." cm".'</br>'.
            "<strong>Gender: </strong>"."{$this->gender}".'</br>'.
            "<strong>Race: </strong>".$this->specie.'</br>'.
            '</br>'."<strong>Starring in:</strong>";
            
            
            //$this->films = implode($this->films);
            $filmString = "";
            foreach($this->films as $filmer){
            

                $films = new Film($filmer);
                $filmString = $films->title;
                
                echo '</br>'."<a href='_char_movies.php?charMovies=$filmString'>$filmString</a>";
                      
                
            }
        }       
    }
}

Class Film {
    public $title;
    
    function __construct($filmUrl){  
        $file = file_get_contents($filmUrl);
        $data = json_decode($file);
        $title = $data->title;
        $this->title = $title;
    }

}

?>