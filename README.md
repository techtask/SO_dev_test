Notes
===========================

I decided to have some fun with this and try to write a whole framework from scratch.
It didn't work out so well, so in the end I just focussed on the Console output.

You can run the test with the tool in the bin directory (tool):


```
tool list-posts
tool show-post [id]
tool import-posts [files]
```

Note that I purposefully did not embellish the html templates in order to focus on developing the framework.

It should take minimal effort to allow this to also be accessible via http. It just needs
a few controllers.

A few things I ran out of time for:

* Parameter validation and Type checking (this should be done in the model either in the constructor, or during a setParameter() method.)
* Decent sanitization/validation routines. I have put in the basics, but these would not be production ready.
* Request/Response objects and dispatcher. These I skipped for brevity.
* Real templating. I decided to use php native templating for simplicity. Twig would probably have been better.
* Tests, phpdoc comments.
* Exception Handler and Logging. I would use the psr-3 logger, but I don't see a particular use for it in this project.


silverorange Developer Test
===========================

Provided basic PDO framework with some data fixtures for authors and Markdown
formatted posts:

 1. create an importer that imports a list of post files (some will be
    provided) into the database
 2. create a tool that given a post id from the database, renders the post
    content (title, body, author) as an HTML document
 3. create a tool that renders a list of posts with authors as an HTML document

The HTML rendering script does not have to be a web server—you can just dump
HTML to STDOUT. If you want to use PHP's built-in server (`php -S`) or an
existing web framework, that is acceptable.

Please use [PSR-2 and PSR-4](http://www.php-fig.org/psr/) for your code. The
[PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) tool can be used to check
your code. Please use the [Composer](https://getcomposer.org/) tool for
dependency management. You can use any 3rd-party libraries as necessary or
as desired in order to achieve the tasks.

Your commit history is important to us! Try to make meaningful commit messages
that show your progress.

Database
--------
The provided SQL files will run in PostgreSQL. PostgreSQL can be installed
using `brew` on macOS or using your distro's package manager in Linux. To
create a new database and import the fixture data, run:

```
createdb silverorange_dev_test -O $(whoami) -U postgres
psql silverorange_dev_test < sql/accounts.sql
psql silverorange_dev_test < sql/posts.sql
```

Starting fresh is as simple as:
```
dropdb silverorange_dev_test -U postgres
```
