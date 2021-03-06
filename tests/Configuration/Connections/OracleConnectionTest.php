<?php

use Illuminate\Contracts\Config\Repository;
use LaravelDoctrine\ORM\Configuration\Connections\OracleConnection;
use Mockery as m;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

class OracleConnectionTest extends TestCase
{
    /**
     * @var Mock
     */
    protected $config;

    /**
     * @var OracleConnection
     */
    protected $connection;

    protected function setUp(): void
    {
        $this->config = m::mock(Repository::class);

        $this->connection = new OracleConnection($this->config);
    }

    public function test_can_resolve()
    {
        $resolved = $this->connection->resolve([
            'driver'              => 'oci8',
            'host'                => 'host',
            'database'            => 'database',
            'username'            => 'username',
            'password'            => 'password',
            'charset'             => 'charset',
            'port'                => 'port',
            'prefix'              => 'prefix',
            'defaultTableOptions' => [],
            'persistent'          => 'persistent',
        ]);

        $this->assertEquals('oci8', $resolved['driver']);
        $this->assertEquals('host', $resolved['host']);
        $this->assertEquals('database', $resolved['dbname']);
        $this->assertEquals('username', $resolved['user']);
        $this->assertEquals('password', $resolved['password']);
        $this->assertEquals('charset', $resolved['charset']);
        $this->assertEquals('port', $resolved['port']);
        $this->assertEquals('prefix', $resolved['prefix']);
        $this->assertCount(0, $resolved['defaultTableOptions']);
        $this->assertEquals('persistent', $resolved['persistent']);
    }

    protected function tearDown(): void
    {
        m::close();
    }
}
