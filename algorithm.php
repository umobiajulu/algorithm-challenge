<?php
    class printer{
        protected $pixel_height;
        protected $character;
        protected $display;
        protected $string;
        protected $alphabets;
        public function __construct($string, $character, $display = 0){
            $this->string = strtoupper($string);
            $this->character = $character;
            $this->display = $display;
            $this->pixel_height = 5;
            $this->alphabets = [
                "A" => [[0,0,1,0,0], [0,1,0,1,0], [1,1,1,1,1],[1,0,0,0,1],[1,0,0,0,1]],
                "B" => [[1,1,1,1,0], [1,0,0,0,1], [1,1,1,1,0],[1,0,0,0,1],[1,1,1,1,0]],
                "C" => [[0,1,1,1,1], [1,0,0,0,0], [1,0,0,0,0],[1,0,0,0,0],[0,1,1,1,1]],
                "D" => [[1,1,1,0,0], [1,0,0,1,0], [1,0,0,0,1],[1,0,0,1,0],[1,1,1,0,0]],
                "E" => [[1,1,1,1,1], [1,0,0,0,0], [1,1,1,1,0],[1,0,0,0,0],[1,1,1,1,1]],
                "F" => [[1,1,1,1,1], [1,0,0,0,0], [1,1,1,1,0],[1,0,0,0,0],[1,0,0,0,0]],
                "G" => [[0,0,1,1,1], [0,1,0,0,0], [1,0,0,1,1],[0,1,0,0,1],[0,0,0,1,1]],
                "H" => [[1,0,0,0,1], [1,0,0,0,1], [1,1,1,1,1],[1,0,0,0,1],[1,0,0,0,1]],
                "I" => [[1,1,1,1,1], [0,0,1,0,0], [0,0,1,0,0],[0,0,1,0,0],[1,1,1,1,1]],
                "J" => [[1,1,1,1,1], [0,0,1,0,0], [0,0,1,0,0],[1,0,1,0,0],[1,1,1,0,0]],
                "K" => [[1,0,0,0,1], [1,0,0,1,0], [1,1,1,0,0],[1,0,0,1,0],[1,0,0,0,1]],
                "L" => [[1,0,0,0,0], [1,0,0,0,0], [1,0,0,0,0],[1,0,0,0,0],[1,1,1,1,1]],
                "M" => [[1,1,0,1,1], [1,0,1,0,1], [1,0,0,0,1],[1,0,0,0,1],[1,0,0,0,1]],
                "N" => [[1,0,0,0,1], [1,1,0,0,1], [1,0,1,0,1],[1,0,0,1,1],[1,0,0,0,1]],
                "O" => [[0,1,1,1,0], [1,0,0,0,1], [1,0,0,0,1],[1,0,0,0,1],[0,1,1,1,0]],
                "P" => [[1,1,1,1,0], [1,0,0,0,1], [1,1,1,1,0],[1,0,0,0,0],[1,0,0,0,0]],
                "Q" => [[0,1,1,1,0], [1,0,0,0,1], [1,0,0,0,1],[0,1,1,1,0],[0,0,0,0,1]],
                "R" => [[1,1,1,1,0], [1,0,0,0,1], [1,1,1,1,0],[1,0,0,1,0],[1,0,0,0,1]],
                "S" => [[0,1,1,1,1], [1,0,0,0,0], [0,1,1,1,0],[0,0,0,0,1],[1,1,1,1,0]],
                "T" => [[1,1,1,1,1], [0,0,1,0,0], [0,0,1,0,0],[0,0,1,0,0],[0,0,1,0,0]],
                "U" => [[1,0,0,0,1], [1,0,0,0,1], [1,0,0,0,1],[1,0,0,0,1],[0,1,1,1,0]],
                "V" => [[1,0,0,0,1], [1,0,0,0,1], [1,0,0,0,1],[0,1,1,1,0],[0,0,1,0,0]],
                "W" => [[1,0,0,0,1], [1,0,0,0,1], [1,0,0,0,1],[1,0,1,0,1],[1,1,0,1,1]],
                "X" => [[1,0,0,0,1], [0,1,0,1,0], [0,0,1,0,0],[0,1,0,1,0],[1,0,0,0,1]],
                "Y" => [[1,0,0,0,1], [0,1,0,1,0], [0,0,1,0,0],[0,0,1,0,0],[0,0,1,0,0]],
                "Z" => [[1,1,1,1,1], [0,0,0,1,0], [0,0,1,0,0],[0,1,0,0,0],[1,1,1,1,1]],
                "*" => [[0,0,0,0,0], [0,0,0,0,0], [0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]],
            ];
        }
        public function pixel_display($alphabet){
            foreach($alphabet as $value){
                echo($value == 0 ? " " : $this->character);
            }
            echo("  ");
        }
        public function print(){
            if($this->display == 0){
                $strings = str_split(preg_replace('!\s+!', '*', $this->string));
                for($ph = 0; $ph < $this->pixel_height; $ph ++){
                    foreach($strings as $string){
                        $this->pixel_display($this->alphabets[$string][$ph]);
                    }
                    echo("\r\n");
                }
            }
            else{
                $words = explode("*", preg_replace('!\s+!', '*', $this->string));
                foreach($words as $word){
                    $strings = str_split($word);
                    for($ph = 0; $ph < $this->pixel_height; $ph ++){
                        $line = [];
                        foreach($strings as $string){
                            $line = array_merge($line, $this->alphabets[$string][$ph],['*']);
                        }
                        for($ph2 = 0; $ph2 < $this->pixel_height; $ph2 ++){
                            foreach($line as $value){
                                if($value != 1){
                                    $this->pixel_display($this->alphabets["*"][$ph2]);
                                }
                                else{
                                    $this->pixel_display($this->alphabets["C"][$ph2]);
                                }
                            }
                            echo("\r\n");
                        }
                        echo("\r\n");
                    }
                    echo("\r\n");
                }
            }
        }
    }
    $string = readline('input your the string to print : ');
    $character = readline('input the character you want to use : ');
    $display = readline('input display type, 1 for multiple, 0 for single : ');
    (new printer($string, $character, $display))->print();
?>