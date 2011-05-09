CSRF Scanner
============

Protecting against CSRF is easy, and testing whether that protection is actually 
present, is also easy. But testing a multitude of sites continuously is a drag. 

The typical flow of CSRF Scanner is as follows:
- spider a website to find all pages
- on each page, find all forms
- submits each form while messing with the token
- checks whether they are sufficiently protected. 

WARNING
-------
Don't test this on a live site, as it will perform all kinds of form submissions 
which you might not like, screw up your database and probably DoS the site as well.

Use on a disposable test site!

Assumptions
-----------
At the moment, the scanner assumes that to be protected:
- every form must have a hidden token field,
- changing or removing that token field should cause a 403 Forbidden response.
Different rules can be added however. 
Spidering is restricted to the domains of the startpages (as defined in the profile)

What it doesn't do
------------------
- If on your site, GET requests can cause damage, this tool will not detect that. Just never allow GET for non-idempotent requests.
- Javascript submissions etc 
- When forms have multiple submit buttons, the form is only tested for one of them.
- Fragments (the part after the # in a URI) are ignored

Usage
-----
* git clone url/to/csrf-scanner csrf-scanner
* Create a file called yoursite.profile, see tests/minisite.profile.dist for an example
* bin/csrfscan scan path/to/profile

Login script
------------
Usually you'll want to login to a site before running the scan. You can do this by adding a prescript in the profile:

```
$this->setPreScript(function($client) {
	$crawler = $client->request('get', 'http://site/loginpage');
	$form = $crawler->selectButton('btn-login')->form();
	$form->setValues(array('username' => 'myname', 'password' => 'test'));
	$client->submit($form);
});
```

Output
------
The output looks something like this:
```
http://localhost:8888/csrfscan-minisite/

http://localhost:8888/csrfscan-minisite/tokennotcheckedform.php
   |_ tokennotcheckedform
      |_ 403 response expected, but got a 200

http://localhost:8888/csrfscan-minisite/notokenform.php
   |_ notokenform
      |_ No 'token' input field found

http://localhost:8888/csrfscan-minisite/goodform.php
   |_ goodform
   |_ bogusform
      |_ No 'token' input field found

http://localhost:8888/csrfscan-minisite/nestedpage.php
```

Todo
----
- Sometimes the same form is repeated on different pages. Form equality could be a combination of action url, method, and fields. 
- It should be possible to put links (or regexes?) in a blacklist, eg to avoid clicking a 'logout' link