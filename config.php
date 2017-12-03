<?php
$_ENV['DB_HOST'] = getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost';
$_ENV['DB_USER'] = getenv('DB_USER') ? getenv('DB_USER') : 'root';
$_ENV['DB_PASS'] = getenv('DB_PASS') ? getenv('DB_PASS') : '';
$_ENV['DB_PORT'] = getenv('DB_PORT') ? getenv('DB_PORT') : null;
$_ENV['DB_NAME'] = getenv('DB_NAME') ? getenv('DB_NAME') : 'tmstock';
