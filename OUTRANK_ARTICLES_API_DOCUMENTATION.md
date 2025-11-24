# Outrank Articles API Documentation

This document provides comprehensive documentation for the Outrank Articles API endpoints. Use this guide when building the frontend UI for displaying articles.

## Base URL

All API endpoints are prefixed with `/api`:

```
Base URL: http://your-domain.com/api
```

---

## Endpoints Overview

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/outrank-articles` | Get all articles with pagination (10 per page) |
| GET | `/outrank-articles/{id}` | Get a specific article by ID |

---

## 1. Get All Articles (Paginated)

Retrieve a paginated list of all articles from the database.

### Endpoint

```
GET /api/outrank-articles
```

### Query Parameters

| Parameter | Type | Required | Default | Description |
|-----------|------|----------|---------|-------------|
| `page` | integer | No | 1 | Page number for pagination |

### Example Request

```javascript
// Get first page
fetch('http://your-domain.com/api/outrank-articles')
  .then(response => response.json())
  .then(data => console.log(data));

// Get page 2
fetch('http://your-domain.com/api/outrank-articles?page=2')
  .then(response => response.json())
  .then(data => console.log(data));
```

### Success Response (200 OK)

```json
{
  "status": "success",
  "message": "Articles retrieved successfully",
  "data": [
    {
      "id": 1,
      "outrank_id": "f1f605ea-2ef3-4474-9ed9-c00b32858e72",
      "title": "Le Guide du Massage du Dos à Paris : Trouvez Votre Soulagement",
      "content_markdown": "Le **massage du dos** est bien plus qu'une simple...",
      "content_html": "<p>Le <strong>massage du dos</strong> est bien plus qu'une simple...</p>",
      "meta_description": "Besoin d'un massage du dos à Paris ? Découvrez les meilleures techniques...",
      "image_url": "https://cdn.outrank.so/.../back-massage-guide-illustration.jpg",
      "slug": "massage-du-dos",
      "tags": [
        "massage du dos",
        "massage paris",
        "bien-être paris",
        "détente musculaire",
        "mal de dos"
      ],
      "outrank_created_at": "2025-11-24T06:39:47.000000Z",
      "webhook_received_at": "2025-11-24T12:22:38.000000Z",
      "event_type": "publish_articles",
      "created_at": "2025-11-24T12:22:38.000000Z",
      "updated_at": "2025-11-24T12:22:38.000000Z"
    }
    // ... 9 more articles (total 10 per page)
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 10,
    "total": 47,
    "from": 1,
    "to": 10
  }
}
```

### Response Fields

#### Article Object

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Standard MySQL auto-incrementing ID (use this for detail page links) |
| `outrank_id` | string | Original UUID from Outrank system |
| `title` | string | Article title |
| `content_markdown` | string | Article content in Markdown format |
| `content_html` | string | Article content in HTML format (use this for display) |
| `meta_description` | string\|null | SEO meta description |
| `image_url` | string\|null | Featured image URL |
| `slug` | string | URL-friendly slug (unique) |
| `tags` | array | Array of tag strings |
| `outrank_created_at` | string\|null | ISO 8601 timestamp when article was created in Outrank |
| `webhook_received_at` | string\|null | ISO 8601 timestamp when webhook was received |
| `event_type` | string\|null | Type of webhook event (usually "publish_articles") |
| `created_at` | string | ISO 8601 timestamp when record was created in database |
| `updated_at` | string | ISO 8601 timestamp when record was last updated |

#### Pagination Object

| Field | Type | Description |
|-------|------|-------------|
| `current_page` | integer | Current page number |
| `last_page` | integer | Total number of pages |
| `per_page` | integer | Number of items per page (always 10) |
| `total` | integer | Total number of articles in database |
| `from` | integer\|null | Starting item number for current page |
| `to` | integer\|null | Ending item number for current page |

### Error Response (500 Internal Server Error)

```json
{
  "status": "error",
  "message": "Failed to retrieve articles",
  "error": "Error message details"
}
```

---

## 2. Get Specific Article by ID

Retrieve a single article by its database ID.

### Endpoint

```
GET /api/outrank-articles/{id}
```

### URL Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | integer | Yes | The database ID of the article (not outrank_id) |

### Example Request

```javascript
// Get article with ID 1
fetch('http://your-domain.com/api/outrank-articles/1')
  .then(response => response.json())
  .then(data => console.log(data));
```

### Success Response (200 OK)

```json
{
  "status": "success",
  "message": "Article retrieved successfully",
  "data": {
    "id": 1,
    "outrank_id": "f1f605ea-2ef3-4474-9ed9-c00b32858e72",
    "title": "Le Guide du Massage du Dos à Paris : Trouvez Votre Soulagement",
    "content_markdown": "Le **massage du dos** est bien plus qu'une simple parenthèse de détente...",
    "content_html": "<p>Le <strong>massage du dos</strong> est bien plus qu'une simple parenthèse de détente...</p>",
    "meta_description": "Besoin d'un massage du dos à Paris ? Découvrez les meilleures techniques...",
    "image_url": "https://cdn.outrank.so/.../back-massage-guide-illustration.jpg",
    "slug": "massage-du-dos",
    "tags": [
      "massage du dos",
      "massage paris",
      "bien-être paris",
      "détente musculaire",
      "mal de dos"
    ],
    "outrank_created_at": "2025-11-24T06:39:47.000000Z",
    "webhook_received_at": "2025-11-24T12:22:38.000000Z",
    "event_type": "publish_articles",
    "created_at": "2025-11-24T12:22:38.000000Z",
    "updated_at": "2025-11-24T12:22:38.000000Z"
  }
}
```

### Error Response (404 Not Found)

```json
{
  "status": "error",
  "message": "Article not found"
}
```

### Error Response (500 Internal Server Error)

```json
{
  "status": "error",
  "message": "Failed to retrieve article",
  "error": "Error message details"
}
```

---

## Frontend Implementation Examples

### React/Next.js Example

```jsx
import { useState, useEffect } from 'react';

function ArticlesList() {
  const [articles, setArticles] = useState([]);
  const [pagination, setPagination] = useState(null);
  const [loading, setLoading] = useState(true);
  const [currentPage, setCurrentPage] = useState(1);

  useEffect(() => {
    fetchArticles(currentPage);
  }, [currentPage]);

  const fetchArticles = async (page) => {
    try {
      setLoading(true);
      const response = await fetch(`http://your-domain.com/api/outrank-articles?page=${page}`);
      const data = await response.json();
      
      if (data.status === 'success') {
        setArticles(data.data);
        setPagination(data.pagination);
      }
    } catch (error) {
      console.error('Error fetching articles:', error);
    } finally {
      setLoading(false);
    }
  };

  if (loading) return <div>Loading...</div>;

  return (
    <div>
      <h1>Articles</h1>
      <div className="articles-grid">
        {articles.map((article) => (
          <div key={article.id} className="article-card">
            {article.image_url && (
              <img src={article.image_url} alt={article.title} />
            )}
            <h2>{article.title}</h2>
            <p>{article.meta_description}</p>
            <div className="tags">
              {article.tags.map((tag, index) => (
                <span key={index} className="tag">{tag}</span>
              ))}
            </div>
            <a href={`/articles/${article.id}`}>Read More</a>
          </div>
        ))}
      </div>

      {/* Pagination Controls */}
      {pagination && (
        <div className="pagination">
          <button 
            disabled={currentPage === 1}
            onClick={() => setCurrentPage(currentPage - 1)}
          >
            Previous
          </button>
          <span>
            Page {pagination.current_page} of {pagination.last_page}
          </span>
          <button 
            disabled={currentPage === pagination.last_page}
            onClick={() => setCurrentPage(currentPage + 1)}
          >
            Next
          </button>
        </div>
      )}
    </div>
  );
}

// Article Detail Component
function ArticleDetail({ articleId }) {
  const [article, setArticle] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`http://your-domain.com/api/outrank-articles/${articleId}`)
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          setArticle(data.data);
        }
      })
      .catch(error => console.error('Error:', error))
      .finally(() => setLoading(false));
  }, [articleId]);

  if (loading) return <div>Loading...</div>;
  if (!article) return <div>Article not found</div>;

  return (
    <article>
      <h1>{article.title}</h1>
      {article.image_url && (
        <img src={article.image_url} alt={article.title} />
      )}
      <div 
        dangerouslySetInnerHTML={{ __html: article.content_html }} 
      />
      <div className="tags">
        {article.tags.map((tag, index) => (
          <span key={index} className="tag">{tag}</span>
        ))}
      </div>
    </article>
  );
}
```

### Vue.js Example

```vue
<template>
  <div class="articles-list">
    <h1>Articles</h1>
    
    <div v-if="loading">Loading...</div>
    
    <div v-else class="articles-grid">
      <article-card
        v-for="article in articles"
        :key="article.id"
        :article="article"
      />
    </div>

    <!-- Pagination -->
    <div v-if="pagination" class="pagination">
      <button 
        :disabled="currentPage === 1"
        @click="goToPage(currentPage - 1)"
      >
        Previous
      </button>
      <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
      <button 
        :disabled="currentPage === pagination.last_page"
        @click="goToPage(currentPage + 1)"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      pagination: null,
      loading: true,
      currentPage: 1
    };
  },
  mounted() {
    this.fetchArticles(this.currentPage);
  },
  methods: {
    async fetchArticles(page) {
      try {
        this.loading = true;
        const response = await fetch(
          `http://your-domain.com/api/outrank-articles?page=${page}`
        );
        const data = await response.json();
        
        if (data.status === 'success') {
          this.articles = data.data;
          this.pagination = data.pagination;
        }
      } catch (error) {
        console.error('Error fetching articles:', error);
      } finally {
        this.loading = false;
      }
    },
    goToPage(page) {
      this.currentPage = page;
      this.fetchArticles(page);
    }
  }
};
</script>
```

### Vanilla JavaScript Example

```javascript
// Fetch all articles with pagination
async function fetchArticles(page = 1) {
  try {
    const response = await fetch(
      `http://your-domain.com/api/outrank-articles?page=${page}`
    );
    const data = await response.json();
    
    if (data.status === 'success') {
      displayArticles(data.data);
      displayPagination(data.pagination);
    }
  } catch (error) {
    console.error('Error fetching articles:', error);
  }
}

// Display articles
function displayArticles(articles) {
  const container = document.getElementById('articles-container');
  container.innerHTML = articles.map(article => `
    <div class="article-card">
      ${article.image_url ? `<img src="${article.image_url}" alt="${article.title}" />` : ''}
      <h2>${article.title}</h2>
      <p>${article.meta_description || ''}</p>
      <div class="tags">
        ${article.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
      </div>
      <a href="/articles/${article.id}">Read More</a>
    </div>
  `).join('');
}

// Fetch single article
async function fetchArticle(id) {
  try {
    const response = await fetch(
      `http://your-domain.com/api/outrank-articles/${id}`
    );
    const data = await response.json();
    
    if (data.status === 'success') {
      displayArticle(data.data);
    } else {
      console.error('Article not found');
    }
  } catch (error) {
    console.error('Error fetching article:', error);
  }
}

// Display single article
function displayArticle(article) {
  const container = document.getElementById('article-container');
  container.innerHTML = `
    <article>
      <h1>${article.title}</h1>
      ${article.image_url ? `<img src="${article.image_url}" alt="${article.title}" />` : ''}
      <div>${article.content_html}</div>
      <div class="tags">
        ${article.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
      </div>
    </article>
  `;
}
```

---

## Important Notes for Frontend Development

### 1. Content Display
- Use `content_html` for displaying article content (it's already formatted as HTML)
- Use `content_markdown` only if you need to parse Markdown yourself

### 2. Article Links
- Use the `id` field (integer) for article detail page links, NOT `outrank_id`
- Example: `/articles/1` not `/articles/f1f605ea-2ef3-4474-9ed9-c00b32858e72`

### 3. Images
- Always check if `image_url` exists before displaying
- Images are hosted on Outrank's CDN: `https://cdn.outrank.so/...`

### 4. Pagination
- Always 10 items per page (fixed)
- Use `pagination.last_page` to determine if "Next" button should be enabled
- Use `pagination.current_page === 1` to determine if "Previous" button should be enabled

### 5. Tags
- Tags are stored as an array of strings
- Always check if tags array exists and has items before mapping

### 6. Error Handling
- Always check `status === 'success'` before using the data
- Handle 404 errors for article detail pages
- Display user-friendly error messages

### 7. Date Formatting
- All timestamps are in ISO 8601 format
- Use a date formatting library (e.g., moment.js, date-fns) to display user-friendly dates

---

## API Response Status Codes

| Code | Meaning | Description |
|------|---------|-------------|
| 200 | OK | Request successful |
| 404 | Not Found | Article with specified ID doesn't exist |
| 500 | Internal Server Error | Server error occurred |

---

## Testing the API

### Using cURL

```bash
# Get all articles (page 1)
curl http://your-domain.com/api/outrank-articles

# Get page 2
curl http://your-domain.com/api/outrank-articles?page=2

# Get specific article
curl http://your-domain.com/api/outrank-articles/1
```

### Using Postman

1. Create a new GET request
2. Set URL to: `http://your-domain.com/api/outrank-articles`
3. Add query parameter `page` if needed
4. Send request

---

## Support

For any issues or questions regarding the API, please contact the backend development team.

---

**Last Updated:** November 24, 2025

