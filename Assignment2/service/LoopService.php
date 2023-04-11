<?php
class LoopService {
    public $loopModel;

    /**
     * Constructor: creates a new LoopModel
     */
    public function __construct(){
        $this->loopModel = new LoopModel();
    }

    /**
     * Chooses the correct LoopType and sets name and result for the LoopModel
     * The result gets provided by a specific method for the different LoopTypes
     * 
     *  @param string $loopType
     *  @param string $until
    */
    public function processLoop($loopType, $until){
        switch($loopType){
            case LoopType::REVERSE->name:
                $this->loopModel->name = "Foreach-Schleife";
                $this->loopModel->result = $this->processReverseLoop();
                break;
            case LoopType::EVEN->name:
                $this->loopModel->name = "For-Schleife";
                $this->loopModel->result = $this->processEvenLoop();
                break;
            case LoopType::UNTIL->name:
                $this->loopModel->name = "While-Schleife";
                $this->loopModel->result = $this->processUntilLoop($until);
                break;
            default:
                break;
        }
    }

    /**
     * $reverse is an array with the same Values as CHARACTERS, therefore it has the same length
     * In foreach loop, we loop through the CHARACTERS array. The index $i starts at 25 and decreases
     * in every step. In setting the current element of CHARACTERS on position $i of $reverse, 
     * we get the reverse order of CHARACTERS
     * 
     * @return string[] $reverse
     */
    private function processReverseLoop(){
        $reverse = CHARACTERS;
        $i = count(CHARACTERS) -1;
        foreach(CHARACTERS as $character){
            $reverse[$i] = $character;
            $i--;
        }
        return $reverse;
    }

    /**
     * $even is an empty array. The for-loop starts at index 1, because it's the index of B,
     * which is the first even element. The loop goes until the length of the CHARACTERS array,
     * in steps of 2 and pushes every element to $even
     * 
     * @return string[] $even
     */
    private function processEvenLoop(){
        $even = array();
        for($i = 1; $i < count(CHARACTERS); $i+=2){
            array_push($even, CHARACTERS[$i]);
        }
        return $even;
    }

    /**
     * $untilArray is an empty array. $limit is the key of the given until value found in the
     * CHARACTERS array. The while-loop starts with index $i = 0 and goes to the limit found before.
     * The element of the CHARACTERS array at position $i gets pushed to the $untilArray
     * 
     * @param string $until
     * @return string[] $untilArray
     */
    private function processUntilLoop($until){
        $untilArray = array();
        $i = 0;
        $limit = array_search($until, CHARACTERS);
        while($i <= $limit){
            array_push($untilArray, CHARACTERS[$i]);
            $i++;
        }
        return $untilArray;
    }
}
