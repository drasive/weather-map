<?php namespace DimitriVranken\weather_map;
      
      abstract class CardinalDirection {
          // Constants
          const None = 0;
          const North = 1;
          const NorthEast = 2;
          const East = 3;
          const SouthEast = 4;
          const South = 5;
          const SouthWest = 6;
          const West = 7;
          const NorthWest = 8;
          
          // Public methods
          public static function getAngle($cardinalDirection) {
              switch ($cardinalDirection) {
                  case \DimitriVranken\weather_map\CardinalDirection::North:
                      $angle = 0;
                      break;
                  case \DimitriVranken\weather_map\CardinalDirection::NorthEast:
                      $angle = 45;
                      break;
                  case \DimitriVranken\weather_map\CardinalDirection::East:
                      $angle = 90;
                      break;
                  case \DimitriVranken\weather_map\CardinalDirection::SouthEast:
                      $angle = 135;
                      break;
                  case \DimitriVranken\weather_map\CardinalDirection::South:
                      $angle = 180;
                      break;
                  case \DimitriVranken\weather_map\CardinalDirection::SouthWest:
                      $angle = 225;
                      break;
                  case \DimitriVranken\weather_map\CardinalDirection::West:
                      $angle = 270;
                      break;
                  case \DimitriVranken\weather_map\CardinalDirection::NorthWest:
                      $angle = 315;
                      break;
              }
              
              return $angle;
          }
      }

?>