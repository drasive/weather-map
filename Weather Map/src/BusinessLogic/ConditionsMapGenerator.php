<?php namespace WeatherMap\BusinessLogic;

       require_once('src/BusinessLogic/WeatherMapGenerator.php');
       require_once('src/UserInterface/ConditionsMapGenerator.php');
      
      class ConditionsMapGenerator extends WeatherMapGenerator {
          
          // Public constructors
          function __construct($date) {
              parent::__construct($date);
          }
          
          // Public methods
          public function generateMap() {
              // TODO: GetDate, return result of UI-map-generator
              
              // Generate map
              $mapGenerator = new \WeatherMap\UserInterface\ConditionsMapGenerator($this->date);
              $map = $mapGenerator->generateMap();
              
              // Return map
              return $map;
          }
          
      }

?>