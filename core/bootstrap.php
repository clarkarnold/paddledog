<?php

require 'includes/db.php';
require 'core/Router.php';
require 'core/Request.php';
$config = require 'includes/config.php';
require 'includes/QueryBuilder.php';

return new QueryBuilder(
	Connection::make($config['database'])
);