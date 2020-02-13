<?php


class Matchstick{
    
    protected $size = 11;
    protected $max = 3;
    protected $i = 0;
    
    public function startgame()
    {
        $player = 0;
        while($this->size >= 0)
        {
            while($this->i < $this->size)
            {
                echo "|";
                $this->i++;
            }
            echo PHP_EOL;
            
            $this->i = 0;
            if($player === 0)
            {
                $number = trim(fgets(STDIN));
    
                switch ($number) {

                    case intval($number) < 0:
                    echo "Error : you have to remove at least one match\n";
                    break;

                    case $number > $this->max:
                    echo "Matches : " . $number . PHP_EOL;
                    echo "Error : not enough matches Matches :\n";
                    break;

                    case !is_numeric($number):
                    echo "Error : invalid input ( positive number expected )\n";
                    break;

                    case is_numeric($number) && $number >= 1 && $number <= 3:
                    if($this->size == 1)
                    {
                        echo "Your turn : Matches : ".$number. "\n";
                        echo "Player removed" . " " .$number. " " . "match(es)\n";
                        echo "You lose... too bad...\n";
                        return;
                    }
                    else{
                        echo "Your turn : Matches : " .$number. "\n";
                        echo "Player removed" . " " .$number. " " . "match(es)\n";
                        $this->size = $this->size - $number;
                        $player++;
                    }
                }
            }
            elseif($player === 1)
            {
                $ran = rand(1, 3);
                echo "AI's turn...\n";

                if ($this->size == 1)
                {
                    echo "I lost ... snif ... but I'll get you next time !!\n";
                    exit;
                }

                if($this->size == 9 || $this->size == 5)
                {
                    echo "Ai removed" . " ". $ran ." " . "match(es)\n";
                    $this->size = $this->size - $ran;
                } 
                else 
                {
                    for( $o = 1; $o <= 3; $o++)
                    {
                        if(($this->size - $o) % 4 == 1)
                        {
                            $take = $o;
                            echo "Ai removed" . " ". $o ." " . "match(es)\n";
                            $this->size = $this->size - $o;
                        }
                    }
                }
                $player--;
            }
        }
    }
}
$game = new Matchstick;
$game->startgame();