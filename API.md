# API Documentation

## Base URL
```
https://watkanikdoen.nl/api/v1
```

## Response Format

### Success Response
```json
{
    "success": true,
    "data": { ... },
    "message": "Success message"
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error message",
    "errors": { ... }
}
```

## Endpoints

### Acties (Events)

#### Get All Acties
```http
GET /api/v1/acties
```

**Query Parameters:**
- `per_page` (integer, max 100): Results per page (default: 15)
- `page` (integer): Page number
- `upcoming` (boolean): Filter by upcoming/past events
- `theme` (string): Filter by theme slug
- `category` (string): Filter by category slug
- `organizer` (string): Filter by organizer slug
- `search` (string): Search in title and body
- `sort_by` (string): Sort by field (start_date, created_at, title, pageviews)
- `sort_order` (string): asc or desc (default: asc)

**Example:**
```http
GET /api/v1/acties?upcoming=true&theme=klimaat&per_page=20
```

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Climate March",
            "body": "<p>Join us for...</p>",
            "externe_link": ["https://example.com"],
            "start_date": "2025-12-15",
            "start_time": "14:00:00",
            "end_date": "2025-12-15",
            "end_time": "18:00:00",
            "start_end": "15 Dec 2025, 14:00-18:00",
            "start_unix": 1734271200,
            "location_human": "Amsterdam Central",
            "geoloc": {
                "lat": 52.3791,
                "lng": 4.9003
            },
            "slug": "climate-march",
            "link": "https://yourdomain.com/actie/climate-march",
            "afgelopen": false,
            "disobedient": false,
            "pageviews": 150,
            "pageviews_text": "150",
            "organizers": [...],
            "categories": [...],
            "themes": [...],
            "image": {...},
            "created_at": "2025-11-01T10:00:00+00:00",
            "updated_at": "2025-11-01T10:00:00+00:00"
        }
    ],
    "links": {...},
    "meta": {...},
    "message": "Success"
}
```

#### Get Single Actie
```http
GET /api/v1/acties/{slug}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "Climate March",
        ...
    },
    "message": "Actie retrieved successfully"
}
```

### Themes

#### Get All Themes
```http
GET /api/v1/themes
```

**Query Parameters:**
- `per_page` (integer, max 100): Results per page (default: 50)
- `page` (integer): Page number
- `search` (string): Search in name
- `sort_by` (string): Sort by field (name, created_at)
- `sort_order` (string): asc or desc

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Klimaat",
            "color": "#00FF00",
            "slug": "klimaat",
            "created_at": "2025-01-01T00:00:00+00:00",
            "updated_at": "2025-01-01T00:00:00+00:00"
        }
    ],
    "links": {...},
    "meta": {...},
    "message": "Success"
}
```

#### Get Single Theme
```http
GET /api/v1/themes/{slug}
```

### Organizers

#### Get All Organizers
```http
GET /api/v1/organizers
```

**Query Parameters:**
- `per_page` (integer, max 100): Results per page (default: 15)
- `page` (integer): Page number
- `search` (string): Search in name and description
- `sort_by` (string): Sort by field (name, created_at)
- `sort_order` (string): asc or desc

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Climate Action",
            "logo": "/storage/logos/climate-action.png",
            "slug": "climate-action",
            "created_at": "2025-01-01T00:00:00+00:00",
            "updated_at": "2025-01-01T00:00:00+00:00"
        }
    ],
    "links": {...},
    "meta": {...},
    "message": "Success"
}
```

#### Get Single Organizer
```http
GET /api/v1/organizers/{slug}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Climate Action",
        "logo": "/storage/logos/climate-action.png",
        "slug": "climate-action",
        "description": "We organize climate actions...",
        "website": "https://climateaction.org",
        "created_at": "2025-01-01T00:00:00+00:00",
        "updated_at": "2025-01-01T00:00:00+00:00"
    },
    "message": "Organizer retrieved successfully"
}
```

### Categories

#### Get All Categories
```http
GET /api/v1/categories
```

**Query Parameters:**
- `per_page` (integer, max 100): Results per page (default: 50)
- `page` (integer): Page number
- `search` (string): Search in name
- `sort_by` (string): Sort by field (name, created_at)
- `sort_order` (string): asc or desc

#### Get Single Category
```http
GET /api/v1/categories/{slug}
```

## Error Codes

- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `429` - Too Many Requests (Rate Limit)
- `500` - Internal Server Error

## Best Practices

1. **Always include pagination** - Use `per_page` parameter to limit results
2. **Cache responses** - API responses include appropriate cache headers
3. **Handle rate limits** - Check rate limit headers and implement retry logic
4. **Use filters** - Combine filters to reduce data transfer
5. **Request only needed fields** - Use relationships efficiently

## CORS

CORS is enabled for all API endpoints. Configure allowed origins in `config/cors.php`.

## Examples

### JavaScript/Fetch
```javascript
// Get upcoming acties
const response = await fetch('https://yourdomain.com/api/v1/acties?upcoming=true', {
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});
const data = await response.json();

// Authenticated request
const response = await fetch('https://yourdomain.com/api/v1/auth/me', {
    headers: {
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
    }
});
```

### cURL
```bash
# Get acties
curl -X GET "https://yourdomain.com/api/v1/acties?upcoming=true" \
  -H "Accept: application/json"

# Login
curl -X POST "https://yourdomain.com/api/v1/auth/login" \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Authenticated request
curl -X GET "https://yourdomain.com/api/v1/auth/me" \
  -H "Authorization: Bearer YOUR_TOKEN"
```
