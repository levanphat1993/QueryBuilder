<?php

include 'db/Query/SqlClauses.php';
include 'db/Query/BaseSqlBuilder.php';
include 'db/Query/MySqlBuilder.php';
include 'db/Query/MySqlConnection.php';

$connection = new MySqlConnection([
	'dbname' => 'test',
	'hostname' => '127.0.0.1',
	'username' => 'root',
	'password' => 'Admin@123#',
]);

$builder = new MySqlBuilder($connection);

$user = $builder
	->select('id', 'fullname')
	->where('id', 1)
	->from('users')
	->first();

print_r($user);

$sql = $builder->select('id', 'fullname')
	->from('users')
	->where('id', '=', 3)
	->getCompiledSelectStatement();

print_r($sql);