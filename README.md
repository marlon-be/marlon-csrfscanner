CSRF Scanner
============

Protecting against CSRF is easy, and testing whether that protection is actually 
present, is also easy. But testing a multitude of sites continuously is a drag. 
CSRF Scanner crawls a website, finds forms, submits them and checks whether they
are sufficiently protected. 

Assumptions
-----------
At the moment, the scanner assumes that to be protected:
- every form must have a hidden token field,
- changing or removing that token field should cause a 403 Forbidden response.
Different rules can be added however. 

What it doesn't do
------------------
If on your site, GET requests can cause damage, this tool will not detect that. 
Just never allow GET for non-idempotent requests.

Usage
-----
* git clone url/to/csrf-scanner csrf-scanner
* Create a file called yoursite.profile, see tests/minisite.profile for an example
* execute bin/csrf-scan scan path/to/profile

WARNING
-------
Don't test this on a live site, as it will perform all kinds of form submissions 
which you might not like, screw up your database and probably DoS the site as well.

Use on a disposable test site!

