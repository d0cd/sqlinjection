# sqlinjection
### Protection from SQL Injection Attack in Express and PHP
The following text is a collection of my experiences in understanding SQL injection attacks and ways to prevent them.

### SQL Injection Attacks
A SQL injection attack is defined as the use of malicious SQL queries to exploit relational databases, for reasons ranging from gaining 
permission to destorying functionality. Some examples of this exploit can be found [here](http://www.unixwiz.net/techtips/sql-injection.html).

### Implementation
The code in the repository are two simple ways to update a database through an HTML form. The one uses Express and some NodeJS modules and the 
other uses PHP, served using XAMPP. The third folder contains configuration files for a sample DB and NGINX/ModSecurity, which will play a huge role in 
mitigating SQL injection exploits on the forms above. The above code is meant to be a fun project and feel free to use at your own risk.

### NodeJS and MySQL
The MySQL javascript client for NodeJs provides a simple way to mitigate SQL injection attacks by allowing queries 
to be prepared and data to be escaped before being put into the query. However, the module has some limitations in
that variables are not truly bound by type and will all be inserted as strings into the query template. While not
robust, this still prevents common injection exploits by preventing addition SQL statements from being added in.

### PHP and MySQL
PHP, while having exposing more vulnerabilities, can be secured much better than NodeJS, provided the correct implementation.
The language allows SQL queries to be prepared with input of a predetermined type. Values can then be excaped and added into 
the predefined query, with little to no room for malicious exploit. More information on prepared statements can be found [here](http://php.net/manual/en/mysqli.quickstart.prepared-statements.php).

### NGINX and ModSecurity
The real heavy hitters in mitigating SQL injection exploits and many other exploits for that matter are NGINX and ModSecurity. The 
former can be used as a web server, reverse proxy, load balancer, etc. In this case, used as a reverse proxy, NGINX can handle traffic
and prevent exploits from even reaching you backend. In order to do this, the reverse proxy must parse through data, which can be pretty
challenging to handle manually. This is where ModSecurity comes in. The web application firewall assigns a threat level to request data 
using a vast quantity of pattern checks. If data reaches a certain threshold, the firewall doesn't allow it through.

### Conclusion
Mitigating exploits is pretty challenging; it is very likely that, despite the precautions you take, there are attack vectors out there 
waiting to be exploited. However, with the combination of parameterized queries and some software, significant steps can be taken towards 
securing your system.
