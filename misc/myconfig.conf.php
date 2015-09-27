<?php
// vim:syn=php

return array(

  // Important! This will put Phabricator into setup mode to help you
  // configure things.
  'phabricator.setup' => false,

  // This will be the base domain for your install, and must be configured.
  // Use "https://" if you have SSL. See below for some notes.
  'phabricator.base-uri' => 'https://phabricator-mydomain.rhcloud.com/',

  // Connection information for MySQL.
  'mysql.host' => getenv('OPENSHIFT_MYSQL_DB_HOST'),
  'mysql.user' => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
  'mysql.pass' => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),

  // Email configuration with Mailgun
  'metamta.default-address' => 'admin@phabricator-mydomain.rhcloud.com',
  'metamta.reply-handler-domain' => 'phabricator-mydomain.rhcloud.com',
  'metamta.domain'          => 'phabricator-mydomain.rhcloud.com',
  'metamta.mail-adapter' => 'PhabricatorMailImplementationMailgunAdapter',
  'mailgun.domain' => 'sandboxXXXXXXXXXXXXXXXX.mailgun.org',
  'mailgun.api-key' => 'key-XXXXXXXXXXXXXXXXXXX'

  'pygments.enabled' => true,

  'environment.append-paths' => array(
    // Needed for non-standard location of Pygments.
    getenv('OPENSHIFT_REPO_DIR').'/repo/pygments/bin',
    // For Graphviz cartridge
    getenv('OPENSHIFT_HOMEDIR') . 'graphviz/usr/bin/'
  ),

  // Needed to import external git repositories
  'repository.default-local-path' => getenv('OPENSHIFT_DATA_DIR')

  // NOTE: Check default.conf.php for detailed explanations of all the
  // configuration options, including these.

) + phabricator_read_config_file('production');
