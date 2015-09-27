# Phabricator Quickstart

A template app to get [Phabricator](https://github.com/facebook/phabricator)
up and running on OpenShift.

# How To Use

## Requirements
* An OpenShift [account](https://openshift.redhat.com).
* 5-10 minutes of free time.

## Create the OpenShift Gear.

```shell
$ rhc-create-app -a phabricator -t php-5.3 -l [your username]
Password: 
Creating application: phabricator in [your namespace]
Now your new domain name is being propagated worldwide (this might take a minute)...
...
Successfully created application: phabricator
```

## Add the MySQL cartridge.

```shell
$ rhc-app cartridge add -c mysql-5.1 -a phabricator -l [your username]
Password: 

RESULT:

MySQL 5.1 database added.  Please make note of these credentials:
...
```

## Add graphviz cartridge (optional)

```shell
rhc  add-cartridge http://cartreflect-claytondev.rhcloud.com/github/puzzle/openshift-graphviz-cartridge --app phabricator

RESULT:

Adding http://cartreflect-claytondev.rhcloud.com/github/puzzle/openshift-graphviz-cartridge to application 'phabricator' ... Password: ******
done
```

## Create a Mailgun account
Then you can add your Mailgun keys inside myconfig.conf.php (next step)
To enable inboud emails you can add a default route in Mailgun config 
  route: catch_all()
  action: forward("https://phabricator.example.com/mail/mailgun/")

## Pull in this Quickstart repository.

```shell
$ cd phabricator
$ git remote add quickstart git://github.com/CodeBlock/phabricator-openshift-quickstart.git
$ git pull quickstart master
From git://github.com/CodeBlock/phabricator-openshift-quickstart
 * branch            master     -> FETCH_HEAD
Updating f1f79ce..303e532
...
```

## Move the config file in to place and customize it.

```shell
$ cp misc/myconfig.conf.php.dist misc/myconfig.conf.php
$ $EDITOR misc/myconfig.conf.php
$ git add -f misc/myconfig.conf.php
$ git commit -m 'Added my own configuration file.'
```

Be sure to edit the domain name to point to your namespace/app.

## Push everything to openshift.

```shell
$ git push origin master
Counting objects: 16, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (9/9), done.
Writing objects: 100% (10/10), 2.13 KiB, done.
...
```

## Create an account for yourself

```shell
# Figure out what to ssh to.
$ grep rhcloud .git/config | sed 's/.*\/\(.\+\)\/~.*/\1/g'
[some random username]@phabricator-[your namespace].rhcloud.com

$ ssh [output from above]
```

Once you've ssh'd to the application, create a user using phabricator's `accountadmin`.

```shell
$ PHABRICATOR_ENV=custom/myconfig ./phabricator/repo/phabricator/bin/accountadmin
[follow the wizard to create a user]
```

## And finally...

Go to it in your browser:

https://phabricator-[your namespace].rhcloud.com/

Have fun!

# Notes

## Repository location

OpenShift gives (as of this writing) 1GB of space with each gear by default.
You can request more space, however. See the instructions
[here](https://openshift.redhat.com/community/faq/how-much-disk-space-do-i-get-with-openshift).

An important note is that every time you deploy to OpenShift, your live app
gets deleted and recreated from the new push. This means that any changes you
make to the live app (via ssh, for example), will get overwritten.

Because if this, it's imporant to place clones of repositories that Phabricator tracks,
in a "safe" location. In OpenShift terms, this location is `../data/`, relative to the
live repository. Also known as `$OPENSHIFT_GEAR_DIR/data`. Files/directories in `../data`
are persistent through deployments.

## Pygments

Pygments are working decently with Phabricator, now that upstream
[D3091](https://secure.phabricator.com/D3091) has landed. Behind the scenes,
the Quickstart will set up a python 'virtualenv' in your repository space when you
deploy. This means 1) we are able to install Pygments into this environment, and use
it; and 2) Every time you deploy (since your live repository space gets deleted and
re-created), you get the latest Pygments automatically. Have fun!

## Graphviz

This tool is used as a custom interpreter in order to draw great graphs inside Phriction wiki
This is nice for documenting a piece of code, draw data base schemas, class diagrams  etc
Unfortunately, the default support for 'dot' remarkup has been removed from upstream because 
it has proven to be a security threat. So... at your own risk ;-)


# Thanks

Thanks Evan Priestley and the team for developing this awesome tool (Phabricator)
Thanks Ricky Elrod for getting this working on OpenShift

