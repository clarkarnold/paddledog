<?php

require 'includes/db.php';
$config = require 'includes/config.php';
require 'includes/QueryBuilder.php';

return new QueryBuilder(
	Connection::make($config['database'])
);