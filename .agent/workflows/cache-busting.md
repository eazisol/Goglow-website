# Cache Busting Workflow

After deploying new CSS or JavaScript changes:

```bash
php artisan version:bump
php artisan config:cache
```

This will:
- Bump version (e.g., 1.0.0 → 1.0.1)
- Clear config cache so new version takes effect

## Alternative Methods

**Environment Variable**: Set in `.env`:
```
ASSET_VERSION=1.1.0
```

**Manual**: Edit `config/version.php` directly
