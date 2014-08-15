<?php namespace WeatherMap\BusinessLogic;

      class DateTimeHelper {
          
          // Private methods
          private static function isTodayWithOffset($date, $todayDayOffset) {
              $dateYear = getdate($date)['year'];
              $dateMonth = getdate($date)['mon'];
              $dateDayOfMonth= getdate($date)['mday'];
              
              $today = getdate();
              $todayYear = getdate($today)['year'];
              $todayMonth = getdate($today)['mon'];
              $todayDayOfMonth= getdate($today)['mday'] + $todayDayOffset;

              return ($dateYear == $todayYear && $dateMonth == $todayMonth && $dateDayOfMonth == $todayDayOfMonth);
          }
          
          // Public methods
          public static function isToday($date) {
              return self::isTodayWithOffset($date, 0);
          }

          public static function isTomorrow($date) {
              return self::isTodayWithOffset($date, 1);
          }
          
      }

?>