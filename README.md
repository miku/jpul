# STATUS: UNMAINTAINED

----

About jpul
==========

Jobboard, University of Leipzig, Career Center.

........................................................................

Developer Topics
================

Directories
-----------

apache/
    Apache conf for local development, adjust at your discretion.

assets/
    Belongs to Yii.
    http://stackoverflow.com/questions/1679151/whats-the-proper-way-to-work-with-assets-in-yii

benchmarks/
    Untracked. Just some `ab` stats.

css/
    Used by Yii.
    All css.

docs/
    Documentation and assets. Not Yii-related.

dumps/
    Our developer DB dumps. Not Yii-related.

ext/
    External pages for testing and show-casing. Not Yii-related.
    Includes some helper scripts now, mainly: `jobportal-mount`, which
    establishes a ssh-in-ssh connection through transparent sockets.

images/
    Used by Yii.

js/
    Used by Yii.

migrations/
    DB migrations. Filename format: XXX-short-description.sql
    These migrations are the means of DB updates. SQL should not
    be applied manually on the DB, but with a specified migration.
    This way, all changes are documented. Each migration must end
    with an INSERT into the schema_version table. E.g.

        INSERT INTO schema_version(`migration_code`, `extra_notes`)
            VALUES ('010', 'cleanup test jobs');

    If one has to rebuild a DB-schema from scratch, `cat` all migrations
    in one big SQL, which is ready for import.

protected/
    All Yii. protected/data holds our current SQL schemes.

themes/
    Used by Yii, but not used by us.

uploads/
    Our generic upload folder. Used by Yii.
    protected/components/Controller.php provides a method for
    retrieving the path: ``string getUploadPath()``




Rolling out new code
--------------------

OS X
....

    Log in to wwwdup.uni-leipzig.de (via MacFuse / MacFusion)
    The script ext/jobportal-mount can be used
    (just adjust your TARGET directory). There is a short story
    in that script, too, about how use an ssh proxy for ssh itself.

        $ cd /Volumes/jobp--wwwdup.uni-leipzig.de
        $ # or whatever TARGET~

    Create a dump. Always.

        $ zip -r webdir.`epoch`.zip webdir/
        $ cp webdir.1296641156.zip ~/projects/jobportal-uni-leipzig/dumps

    Create a full dump of the MySQL DB (via phpmysql) -
        with COMPATIBILITY MODE = NONE.

    Now check, if there are any outstanding DB migrations (take a look at
    the schema_version column).

    Is the site still up? Good.

    Now pull the source directly into webdir, so ...

        $ cd /Volumes/jobp--wwwdup.uni-leipzig.de/webdir
        $ git st

    Deal with any outstanding live changes or untracked file.

        $ git pull origin master

    ================

    Using patches to updates.

    sshfs is flaky on pulls with more than only a few commits (why?). To
    counteract this, you can update production via patches.

    Create a patch on your development machine. The last commit on production
    should be the starting point.

        $ git format-patch --stdout 6f74cc68..$(cat .git/refs/heads/master) > update.patch

    Copy the patch to your TARGET. Check the patch:

        $ git apply --check update.patch

    If everything is fine, apply:

        $ git apply update.patch


Search query language
---------------------

    See: http://framework.zend.com/manual/en/zend.search.lucene.query-language.html


Temporarily disabling the application
-------------------------------------

Rename index.php to something else, e.g. index.php.offline;
index.html will be dislaying a placeholder nice image instead.

Nice URLs?
----------

* http://www.yiiframework.com/doc/guide/1.1/en/topics.url
* http://www.yiiframework.com/forum/index.php?/topic/7803-how-to-remove-index-php-from-url/

