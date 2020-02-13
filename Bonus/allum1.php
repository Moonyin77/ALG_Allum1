<?php


class Matchstick{
    
    protected $size;
    protected $max = 3;
    protected $i = 0;

    public function startgame()
    {
        $player = 0;
        echo "\e[1;36mMATCHSTICKERS\e[m\n";
        echo "\e[1;36mGOOOOOOOOOOOOOOOOOOOOO but first... we need some matches... don't you think?\e[m\n";
        echo "\e[1;36mHow much matches do you want?\e[m\n";
        $this->size = trim(fgets(STDIN));
        if($this->size >= 10)
        {
            while($this->size >= 0)
            {
                while($this->i < $this->size)
                {
                    echo "\e[1;33m|\e[m";
                    $this->i++;
                }
                echo PHP_EOL;
                
                $this->i = 0;
                if($player === 0)
                {
                    $number = trim(fgets(STDIN));
                    switch ($number) {
                        case intval($number) < 0:
                        echo "\e[1;31mError : you have to remove at least one match\n \e[m";
                        break;

                        case $number > $this->max:
                        echo "\e[1;32mMatches : " . $number  . "\e[m". PHP_EOL;
                        echo "\e[1;31mError : not enough matches Matches :\n \e[m";
                        break;

                        case !is_numeric($number):
                        echo "\e[1;31mError : invalid input ( positive number expected )\n \e[m";
                        break;

                        case is_numeric($number) && $number >= 1 && $number <= 3:
                        if($this->size == 1)
                        {
                            echo "\e[1;32mYour turn : Matches : ".$number. "\n \e[m";
                            echo "\e[1;32mPlayer removed" . " " .$number. " " . "match(es)\n \e[m";
                            echo "\e[1;31mYou lose... too bad...\n \e[m";
                            return;
                        }
                        else{
                            echo "\e[1;32mYour turn : Matches : " .$number. "\n \e[m";
                            echo "\e[1;32mPlayer removed" . " " .$number. " " . "match(es)\n \e[m";
                            $this->size = $this->size - $number;
                            $player++;
                        }
                    }
                }
                elseif($player === 1)
                {
                    $ran = rand(1, 3);
                    echo "\e[1;34mAI's turn...\n \e[m";

                    if ($this->size == 1)
                    {
                        echo "\e[1;31mI lost ... snif ... but I'll get you next time !!\n \e[m";
                        exit;
                    }
                    if($this->size == 5 || $this->size == 9 || $this->size == 13)
                    {
                        echo "\e[1;34mAi removed" . " ". $ran ." " . "match(es)\n \e[m";
                        $this->size = $this->size - $ran;
                    } 
                    else 
                    {
                        for( $o = 1; $o <= 3; $o++)
                        {
                            if(($this->size - $o) % 4 == 1)
                            {
                                $take = $o;
                                echo "\e[1;34mAi removed" . " ". $o ." " . "match(es)\n \e[m";
                                $this->size = $this->size - $o;
                            }
                        }
                    }
                    $player--;
                }
            }
        }
        else
        {
            echo "\e[1;31mYou need minimum 10 matches\e[m";
        }
    }
}
$game = new Matchstick;
$game->startgame();