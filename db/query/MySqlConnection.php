<?php

class MySqlConnection
{
	/** @var PDO $pdo */
	protected $pdo;

	public function __construct(array $config)
	{
		$this->open($config);
	}

	public function __destruct()
	{
		$this->close();
	}

	private final function open(array $config)
	{
		$this->pdo = new PDO(
			$this->getConnectionString($config),
			$config['username'],
			$config['password']
		);
	}

	private final function close()
	{
		$this->pdo = null;
	}

	protected function getConnectionString(array $config)
	{
		return 'mysql:dbname=' . $config['dbname'] . ';host=' . $config['hostname'];
	}

	public final function execute($sql)
	{
		return $this->pdo->exec($sql);
	}

	public final function query($sql, array $params = [])
	{
		if (! empty($params)) {
			$sth = $this->pdo->prepare($sql);
			$sth->execute($params);
			return $sth;
		}

		return $this->pdo->query($sql);
	}
}