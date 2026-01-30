# API

## What it is
The API is served by the `api` Service. It returns JSON responses and supports API keys, CORS allowlists, and rate limiting.

## Where it lives (folder)
- Service: `services/api.php`
- JSON helper: `core/classes/api-class.php`
- API containers: `containers/api/`
- API storage: `data/api_notes.json`, `data/api_rate_limit.json`

## Minimal example
```text
/api/v1/health
```

## How to run / test
1. Add API keys in `.env`:
   ```ini
   API_KEYS="your-key-1,your-key-2"
   ```
2. Request a protected endpoint with a key:
   ```bash
   curl -H "X-API-Key: your-key-1" http://localhost/api/v1/notes
   ```

Source: services/api.php, core/classes/api-class.php.

---

## JSON Response Shape

Responses include:
- `success`
- `message`
- `data`
- `errors`
- `meta`

Source: services/api.php, core/classes/api-class.php.

---

## API Keys

The API checks for keys in:
- `Authorization: Bearer <key>`
- `X-API-Key` header
- `api_key` query param

Keys are loaded from `API_KEYS` in `.env`.

Source: services/api.php.

---

## CORS Allowlist

CORS settings are controlled by `API_CORS_ALLOWLIST` in `.env`.
- Use `*` to allow all origins.
- Use a comma-separated list for specific origins.

Source: services/api.php.

---

## Rate Limiting

Rate limiting uses:
- `API_RATE_LIMIT`
- `API_RATE_WINDOW`

Data is stored in `data/api_rate_limit.json`.

Source: services/api.php.
