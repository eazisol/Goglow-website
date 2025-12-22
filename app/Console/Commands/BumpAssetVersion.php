<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Artisan command to bump the asset version for cache busting
 * 
 * Usage:
 *   php artisan version:bump           # Auto-increment patch version
 *   php artisan version:bump --set=2.0.0  # Set specific version
 */
class BumpAssetVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:bump {--set= : Set a specific version instead of auto-incrementing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bump the asset version for cache busting';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $configPath = config_path('version.php');
        
        if (!File::exists($configPath)) {
            $this->error('Config file not found: config/version.php');
            return 1;
        }

        $currentVersion = config('version.assets', '1.0.0');
        
        // Determine new version
        $setVersion = $this->option('set');
        if ($setVersion) {
            $newVersion = $setVersion;
        } else {
            // Auto-increment patch version
            $parts = explode('.', $currentVersion);
            if (count($parts) === 3) {
                $parts[2] = (int)$parts[2] + 1;
                $newVersion = implode('.', $parts);
            } else {
                $newVersion = $currentVersion . '.1';
            }
        }

        // Update the config file
        $content = <<<PHP
<?php

/**
 * Asset Version Configuration
 * 
 * This version string is appended to all CSS and JS assets as a query parameter
 * for cache busting. Update this value during deployment to force browsers to
 * download fresh copies of assets.
 * 
 * Usage in Blade templates:
 *   {{ \App\Helpers\AssetHelper::versioned('css/style.css') }}
 *   
 * Update methods:
 *   1. Run: php artisan version:bump (auto-increments patch version)
 *   2. Set ASSET_VERSION in .env file
 *   3. Manually edit this file
 */

return [
    'assets' => env('ASSET_VERSION', '{$newVersion}'),
];
PHP;

        File::put($configPath, $content);

        $this->info("Asset version bumped: {$currentVersion} → {$newVersion}");
        $this->line('');
        $this->line('Next steps:');
        $this->line('  1. Run: php artisan config:cache');
        $this->line('  2. Deploy your application');
        
        return 0;
    }
}
