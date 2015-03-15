Proj1 Submission
----------------

Project Memebers:
-----------------

1) Vijaya Kumar Venkatramanan
2) Sina Kashuk


checking the project result:
----------------------------
1) Go to http://134.74.146.40/~kas14/p1/start.html
2) There are two links available on the page:
  a) Static page
  b) Dynamic Page
3)Static page leads to query problem 1 to 6 and includes styling as apart of bonus
point problem2.
4) Dynamic link leads to solution to Bonus point problem 1.


Please find report.doc file included attached with the submission. The submission also consist of two zip files 
which consist of dynamic and static implementation of projects.



Overview
---------

This Project uses the following System:

1)Open Layer 
--------------

	 Open Layer is an open source javascript Library used to display map data on web browser.It was used to add
features to the Map such as magnification and scrolling across the map.This feature was added using functions like addcontrol().
Open Layer. 

2) Map Server
---------------

	 Mapserver is an open source system used to develop maps on web browser.It is used as a middleware which 
communicates with spatial database and projects the data to the map on a browser. Mapsever configuration is stored in a file with
an .map extension.

3)PostGreSQL/POSTGIS
--------------------
	 PostGreSQL is an object relational database management system and it is capable of storing spatial data. It supports
psql query language.PostGIS is an open source software program that adds support for geographic objects to the PostgreSQL object-relational
database. POstGIS is a seperate package which has to be installed with postgresql.





Important files or component of the system:
-------------------------------------------


1) template.html
-----------------

HTML5 was used to design front end view where map can be displayed on a web browser.HTML file is integrated with Open Layers JS library. The file also
has reference to each layers defined on the map. A map is initiated by declaring a map command.



2) Map file
------------

Map file consists of all the map's attributes such as imagetype , extent of the map to displayed in terms of langitude and latitude , projection details, output of the image format and Layers. The most important section of a map consits of the defination of layers of maps to be displayed on a web browser. Characteristics of Layers such as type , name ,data , class and style in which layer has to be displayed are defined in each section of layers.
	The data attribute of layer is responsible for making the query to database and rendering the spatial data to be displayed on the map.Data query
is made in psql language and the geometric attribute of the data is fetched. The map file also defines symbols and styles for each type of geomertry
such as point, line , polygon.


3) PHP file 
-------------

The template.php file is to communicate between the client and the server. The parameter passed through the client layer is formed as a request in php file. The PHP files role is to send the request to the mapserver/Postgresql server and to get the response back to the client. There are two ways of sending the request,which are static and dynamic. In static way the PHP file sends the request to the map file which wouold communicate with the database server, i.e. the query to fetch spatial data is present. The Map file also defines the attributes such as type, style ,class of a layer in case of static approach.

In Dynamic approach all the attributes of a layer such as style, type and its symbols description are defined in PHP file. The connection to database is also established in the PHP file and query to fetch the data is fed through the PHP file.




Changes done to the MAP file:

-------------------------------


1)Added symbols which was used to represent different types of geomertical data such as point, line and polygon.

2)Added psql statement to the DATA attribute of each layer.

3)for query 2 , for displaying highway with more than two routes , used two different colours to represent highway. the result was displayed in red colour line. Rest of the highways 
 which arent part of the result was represented using Line - ellipse overlay.

4)Representing Polygon using different RGB colors. Some of the polygon has outline colour like displaying community districs as well as in query 6(Intersect,union and Sym Difference) 




















