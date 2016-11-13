# Task 6 - import sitemap

In newly created repository create new application component that allows adding new websites and pages by importing [sitemap file](http://www.sitemaps.org/).
This functionality should be accessible via both command line and frontend.


## Add new sitemap via console: php console.php sitemap sitemap.xml
> Hint: sitemap.xml is xml file consists sitemap.

Import sitemap via console is autorizated by  user: demo, pass: 123password123


##Task 7

As You may have noticed pages that require logged in user are visible to users, and those that make sense only for not logged in users (like login or registration forms) are visible to logged in users. Introduce modification that will fix this problem (show login form to not logged in users on pages that require user context and show 403 message on login and registration forms when user is logged in).



