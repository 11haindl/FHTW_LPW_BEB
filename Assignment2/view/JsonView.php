<?php
class JsonView {
    /**
     * Constructor: set header
     */
    public function __construct() {
        header('Content-Type: application/json');
    }
    
    /**
     * encodes the given data to JSON and echos it
     */
    public function streamOutput($data){
        $jsonOutput = json_encode($data);
        echo $jsonOutput;
    }
    
}
?>