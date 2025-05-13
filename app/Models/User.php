<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'house',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function database(bool $absolutePath = true): string
    {
        $defaultPath = env('DB_DATABASE', 'database/database.sqlite');

        $databaseDirectory = dirname($defaultPath);
        $databaseFilename  = $this->house . '.sqlite';

        $relativePath = $databaseDirectory . '/' . $databaseFilename;
        $fullPath = base_path($relativePath);

        $this->ensureDatabaseExists($fullPath);

        return $absolutePath ? $fullPath : $relativePath;
    }

    protected function ensureDatabaseExists(string $path): void
    {
        if (!file_exists($path)) {
            $directory = dirname($path);

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            touch($path);
        }
    }
}
