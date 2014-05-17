<?php namespace WeatherMap\UserInterface;

      // TODO:
      // If this file is located deeper than the root directory itself, "../[../]" has to be prepended to this require-path (which makes sense).
      // But every require-path in a class used by this one then has to have the "../[../]" prefix too.
      // This becomes a problem when these classes get used by classes that lie directly in the root directory or at any other depth than this one.
      // How can I ceep the require-pathss in the used classes?
      //
      // Move this class to media/images/generated/ if the problem is fixes. Keep it here otherwise.
      //
      // Damn, that probably the longest meanigful comment I have ever written.
      require_once('src/UserInterface/WeatherMapGenerator.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Public constructors
          function __construct($date) {
              parent::__construct($date);
          }

          // Public methods
          public function generateMap($weatherData) {
              $background = imagecreatefromjpeg('media/images/switzerland_map.jpg');

              // TODO:

              return $background;
          }

      }

?>