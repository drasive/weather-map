# weather-map

Generates and presents weather maps (conditions, temperatures, wind and pollination) for seven regions in Switzerland, using data from a webservice.
This was a school project for module #307 at the [GIB Muttenz](http://www.gibm.ch) (Switzerland).

Attention:
- The default configured webservice provided by the GIBM returns different, __random weather data__ every time it is called. Other data sources can be used, but the parsing has to be adapted to the new data format.
- The user interface and the documentation are in __German__, even though the code is in English.

## Features
- Generates maps for the weather conditions, temperatures, wind and pollination in every region
- The generated maps show weather information for the regions Zurich, Berne, Basle, Geneva, Ticino, Valais and Grisons
- Today's weather as well as the weather forecast for the next six days can be viewed
- Uses caching for the generated weather maps and the received weather data
- Modern, easy to use and responsive user interface
- Well tested

## Installation
Download the latest [release](https://github.com/drasive/weather-map/releases/) and put the extracted files into the directory of your webserver.  
PHP 5.4 or a compatible later version has to be installed on said webserver.

## Documentation
The documentation is available in the [/docs folder](docs).

The project is developed using Visual Studio 2013 with the plugin "PHP Tools for Visual Studio" (proprietary). These tools are neither a requirement for running nor developing the application.

## Screenshots
### 1. Weather conditions map
![Weather conditions map](/docs/_source/conditions_map.png "Weather conditions map")

### 2. Temperatures map
![Temperatures map](/docs/_source/temperatures_map.png "Temperatures map")

## License
The files in this repository are generally released under the MIT License, but some sub-parts (libraries etc.) may be licensed separately.  
Please see the [license file](LICENSE) for further information.
