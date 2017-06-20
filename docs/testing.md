Testing
===============
We have two test configuration files:

File            | Description
----------------|----------------------------------
phpunit.xml     | Standard unit and feature tests. Everything is done locally.
phpunit-all.xml | All tests, including integrations with web services

Normally, you can run `phpunit` to just use the standard tests. When you need to test integrations with remote web services (eg, Stripe), run `phpunit -c phpunit-all.xml`

