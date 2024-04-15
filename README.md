Risk assessment system
======================

This is a PHP class implementing a risk assessment system.

This is implemented by using the [Reviewable assessments system](https://github.com/camunigeog/reviewable-assessments/) library.


Usage
-----

1. Clone the repository.
2. Run `composer install` to install the PHP dependencies.
3. Add the Apache directives in httpd.conf (and restart the webserver) as per the example given in .httpd.conf.extract.txt; the example assumes mod_macro but this can be easily removed.
4. Create a copy of the index.html.template file as index.html, and fill in the parameters.
5. Access the page in a browser at a URL which is served by the webserver.


Dependencies
------------

* Composer package manager


Author
------

Martin Lucas-Smith, Department of Geography, 2013-24.


License
-------

GPL3.

