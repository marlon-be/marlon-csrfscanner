CSRF Scanner
============

Protecting against CSRF is easy, and testing whether that protection is actually 
present, is also easy. But testing a multitude of sites continuously is a drag. 

The typical flow of CSRF Scanner is as follows:
- spider a website to find all pages
- on each page, find all forms
- submits each form while messing with the token
- checks whether they are sufficiently protected. 

Assumptions
-----------
At the moment, the scanner assumes that to be protected:
- every form must have a hidden token field,
- changing or removing that token field should cause a 403 Forbidden response.
Different rules can be added however. 

What it doesn't do
------------------
- If on your site, GET requests can cause damage, this tool will not detect that. Just never allow GET for non-idempotent requests.
- Javascript submissions etc 
- When forms have multiple submit buttons, the form is only tested for one of them

Usage
-----
* git clone url/to/csrf-scanner csrf-scanner
* Create a file called yoursite.profile, see sample.profile for an example
* execute bin/csrfscan scan path/to/profile

WARNING
-------
Don't test this on a live site, as it will perform all kinds of form submissions 
which you might not like, screw up your database and probably DoS the site as well.

Use on a disposable test site!

