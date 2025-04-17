<?php

declare(strict_types=1);

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * Class DatabaseConnection
 *
 * @property int $id
 * @property string $name
 * @property string $driver
 * @property string $host
 * @property int $port
 * @property string $database
 * @property string $username
 * @property string $password
 * @property string|null $charset
 * @property string|null $collation
 * @property string|null $prefix
 * @property bool $strict
 * @property string|null $engine
 * @property array|null $options
 * @property string $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class DatabaseConnection extends Model
{
    /**
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'driver',
        'host',
        'port',
        'database',
        'username',
        'password',
        'charset',
        'collation',
        'prefix',
        'strict',
        'engine',
        'options',
        'status',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'port' => 'integer',
        'strict' => 'boolean',
        'options' => 'array',
    ];

    public function testConnection(): bool
    {
        try {
            $config = [
                'driver' => $this->driver,
                'host' => $this->host,
                'port' => $this->port,
                'database' => $this->database,
                'username' => $this->username,
                'password' => $this->password,
                'charset' => $this->charset ?? 'utf8mb4',
                'collation' => $this->collation ?? 'utf8mb4_unicode_ci',
                'prefix' => $this->prefix,
                'strict' => $this->strict,
                'engine' => $this->engine,
            ];

            if (! empty($this->options)) {
                $config = array_merge($config, $this->options);
            }

            Config::set('database.connections.test_connection', $config);
            DB::connection('test_connection')->getPdo();

            return true;
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }
}
