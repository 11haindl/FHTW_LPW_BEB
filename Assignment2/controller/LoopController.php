<?php
class LoopController {
    private $jsonView;
    private $loopType;
    private $until;
    private $loopService;

    /** 
     * Constructor: create properties jsonView and loopService
     * check if user input is set
     */
    public function __construct()
    {
        $this->jsonView = new JsonView();
        $this->loopService = new LoopService();
        if(isset($_GET['loopType'])){
            $this->loopType = $_GET['loopType'];
        } else {
            echo "No loopType given! Please enter a loopType (REVERSE, EVEN or UNTIL)\n";
        }
        if(isset($_GET['until'])){
            $this->until = $_GET['until'];
        } else {
            $this->until = "";
        }

    }

    /**
     * If the user input is correct, this method starts to process the given input 
     * by calling the loopServices processLoop-method. Then delivers the Output 
     */
    public function route(){
       if($this->isInputCorrect()){
            $this->loopService->processLoop($this->loopType, $this->until);
            $this->getOutput();
        } else {
            echo "Invalid Input\n";
        }
    }

    /**
     * This method checks if the users given loopType is a valid LoopType-ENUM
     */
    private function isInputCorrect(){
        // get Enumeration Values as Array
        $loopTypeArray = array_column(LoopType::cases(), "name");
        // if the users input matches a value of the Array, $matchingIndex is the Index of the 
        // matched value, otherwise it is false
        $matchingIndex = array_search($this->loopType, $loopTypeArray);
        if($matchingIndex !== false){
            return $this->isUntilInputCorrect();
        } else {
            echo "The given LoopType is invalid. Please choose REVERSE, EVEN or UNTIL as LoopType\n";
            return false;
        }
    }

    /**
     * LoopTypes REVERSE and EVEN, do not need an until value. 
     * In this case the users until value is not important, we can always say it's true.
     * If LoopType is UNTIL, the method checks if the given until value is 
     * in the defined CHARACTERS-Array
     */
    private function isUntilInputCorrect(){
        if ($this->loopType !== LoopType::UNTIL->name){
            return true;
        } else {
            return in_array($this->until, CHARACTERS);
        }
    }

    /**
     * Transfers the LoopModel into the wanted Output
     */
    private function getOutput(){
        $loopModel = $this->loopService->loopModel;
        $data = new \stdClass();
        $data->loopName = $loopModel->name;
        $data->result = $loopModel->result;
        $this->jsonView->streamOutput($data);
    }
}
?>