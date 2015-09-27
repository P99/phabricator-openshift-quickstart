<?php
// vim:syn=php

return array(

  // Important! This will put Phabricator into setup mode to help you
  // configure things.
  'phabricator.setup' => false,

  // This will be the base domain for your install, and must be configured.
  // Use "https://" if you have SSL. See below for some notes.
  'phabricator.base-uri' => 'https://phabricator2-codeblock.rhcloud.com/',

  // Connection information for MySQL.
  'mysql.host' => getenv('OPENSHIFT_MYSQL_DB_HOST'),
  'mysql.user' => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
  'mysql.pass' => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),

  // Basic email domain configuration.
  'metamta.default-address' => 'admin@phabricator2-codeblock.rhcloud.com',
  'metamta.domain'          => 'phabricator2-codeblock.rhcloud.com',

  'pygments.enabled' => true,

  // Needed for non-standard location of Pygments.
  'environment.append-paths' => array(
    getenv('OPENSHIFT_REPO_DIR').'/repo/pygments/bin',
  ),

  // Needed to import external git repositories
  'repository.default-local-path' => getenv('OPENSHIFT_DATA_DIR')

  // NOTE: Check default.conf.php for detailed explanations of all the
  // configuration options, including these.

) + phabricator_read_config_file('production');
