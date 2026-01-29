// Blog Page JavaScript
// Handles fetching articles from API and pagination

let currentPage = 1;
let totalPages = 1;
let articles = [];
let pagination = null;

/**
 * Fetch articles from API
 * @param {number} page - Page number to fetch
 */
async function fetchArticles(page = 1) {
    currentPage = page;
    
    // Show loading state
    showLoading();
    hideError();
    hideEmpty();
    hideArticles();
    hidePagination();
    
    try {
        const response = await fetch(`https://backend.glaura.ai/api/outrank-articles?page=${page}`);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.status === 'success') {
            articles = data.data || [];
            pagination = data.pagination || null;
            
            if (pagination) {
                totalPages = pagination.last_page || 1;
                currentPage = pagination.current_page || 1;
            }
            
            if (articles.length === 0) {
                showEmpty();
            } else {
                displayArticles(articles);
                updatePagination();
                showArticles();
                showPagination();
            }
            
            // Update URL without page reload
            updateURL(page);
        } else {
            showError(data.message || 'Failed to retrieve articles');
        }
    } catch (error) {
        console.error('Error fetching articles:', error);
        let errorMessage = 'Failed to load articles. Please check your connection and try again.';
        
        if (error.message && error.message.includes('HTTP error')) {
            errorMessage = 'Unable to connect to the server. Please try again later.';
        }
        
        showError(errorMessage);
    } finally {
        hideLoading();
    }
}

/**
 * Display articles in the grid
 * @param {Array} articlesArray - Array of article objects
 */
function displayArticles(articlesArray) {
    const container = document.getElementById('blog-articles-container');
    
    if (!container) return;
    
    container.innerHTML = articlesArray.map(article => {
        const imageHtml = article.image_url 
            ? `<div class="blog-article-image">
                 <img src="${escapeHtml(article.image_url)}" alt="${escapeHtml(article.title)}" loading="lazy">
               </div>`
            : '';
        
        const tagsHtml = article.tags && article.tags.length > 0
            ? `<div class="blog-article-tags">
                 ${article.tags.map(tag => `<span class="blog-tag">${escapeHtml(tag)}</span>`).join('')}
               </div>`
            : '';
        
        const metaDescription = article.meta_description || '';
        const truncatedDescription = metaDescription.length > 150 
            ? metaDescription.substring(0, 150) + '...' 
            : metaDescription;
        
        return `
            <article class="blog-article-card">
                ${imageHtml}
                <div class="blog-article-content">
                    <h2 class="blog-article-title">
                        <a href="/blogs/${article.id}">${escapeHtml(article.title)}</a>
                    </h2>
                    ${metaDescription ? `<p class="blog-article-excerpt">${escapeHtml(truncatedDescription)}</p>` : ''}
                    ${tagsHtml}
                    <div class="blog-article-footer">
                        <a href="/blogs/${article.id}" class="blog-read-more">
                            ${window.blogTranslations?.readMore || 'Read More'}
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </article>
        `;
    }).join('');
}

/**
 * Update pagination controls
 */
function updatePagination() {
    const prevBtn = document.getElementById('blog-prev-btn');
    const nextBtn = document.getElementById('blog-next-btn');
    const pageInfo = document.getElementById('blog-page-info');
    
    if (!prevBtn || !nextBtn || !pageInfo) return;
    
    // Update page info
    pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
    
    // Update button states
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
}

/**
 * Go to next page
 */
function goToNextPage() {
    if (currentPage < totalPages) {
        fetchArticles(currentPage + 1);
        // Scroll to top of articles
        const container = document.querySelector('.blog-page-section');
        if (container) {
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
}

/**
 * Go to previous page
 */
function goToPreviousPage() {
    if (currentPage > 1) {
        fetchArticles(currentPage - 1);
        // Scroll to top of articles
        const container = document.querySelector('.blog-page-section');
        if (container) {
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
}

/**
 * Update URL query parameter
 * @param {number} page - Page number
 */
function updateURL(page) {
    const url = new URL(window.location);
    if (page === 1) {
        url.searchParams.delete('page');
    } else {
        url.searchParams.set('page', page);
    }
    window.history.pushState({ page }, '', url);
}

/**
 * Show loading state
 */
function showLoading() {
    const loading = document.getElementById('blog-loading');
    if (loading) loading.style.display = 'flex';
}

/**
 * Hide loading state
 */
function hideLoading() {
    const loading = document.getElementById('blog-loading');
    if (loading) loading.style.display = 'none';
}

/**
 * Show error state
 * @param {string} message - Error message
 */
function showError(message) {
    const error = document.getElementById('blog-error');
    const errorMessage = document.getElementById('blog-error-message');
    if (error) error.style.display = 'block';
    if (errorMessage) errorMessage.textContent = message;
}

/**
 * Hide error state
 */
function hideError() {
    const error = document.getElementById('blog-error');
    if (error) error.style.display = 'none';
}

/**
 * Show empty state
 */
function showEmpty() {
    const empty = document.getElementById('blog-empty');
    if (empty) empty.style.display = 'block';
}

/**
 * Hide empty state
 */
function hideEmpty() {
    const empty = document.getElementById('blog-empty');
    if (empty) empty.style.display = 'none';
}

/**
 * Show articles container
 */
function showArticles() {
    const container = document.getElementById('blog-articles-container');
    if (container) container.style.display = 'grid';
}

/**
 * Hide articles container
 */
function hideArticles() {
    const container = document.getElementById('blog-articles-container');
    if (container) container.style.display = 'none';
}

/**
 * Show pagination
 */
function showPagination() {
    const pagination = document.getElementById('blog-pagination');
    if (pagination) pagination.style.display = 'flex';
}

/**
 * Hide pagination
 */
function hidePagination() {
    const pagination = document.getElementById('blog-pagination');
    if (pagination) pagination.style.display = 'none';
}

/**
 * Escape HTML to prevent XSS
 * @param {string} text - Text to escape
 * @returns {string} Escaped text
 */
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Handle browser back/forward buttons
window.addEventListener('popstate', function(event) {
    const urlParams = new URLSearchParams(window.location.search);
    const page = parseInt(urlParams.get('page')) || 1;
    fetchArticles(page);
});

/**
 * Fetch single article detail from API
 * @param {number} id - Article ID
 */
async function fetchArticleDetail(id) {
    // Show loading state
    showDetailLoading();
    hideDetailError();
    hideDetailContent();
    
    try {
        const response = await fetch(`https://backend.glaura.ai/api/outrank-articles/${id}`);
        
        if (!response.ok) {
            if (response.status === 404) {
                showDetailError('Article not found');
                return;
            }
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.status === 'success' && data.data) {
            displayArticleDetail(data.data);
            showDetailContent();
        } else {
            showDetailError(data.message || 'Failed to retrieve article');
        }
    } catch (error) {
        console.error('Error fetching article detail:', error);
        let errorMessage = 'Failed to load article. Please check your connection and try again.';
        
        if (error.message && error.message.includes('HTTP error')) {
            errorMessage = 'Unable to connect to the server. Please try again later.';
        }
        
        showDetailError(errorMessage);
    } finally {
        hideDetailLoading();
    }
}

/**
 * Display article detail
 * @param {Object} article - Article object
 */
function displayArticleDetail(article) {
    // Set title
    const titleEl = document.getElementById('blog-detail-title');
    if (titleEl) {
        titleEl.textContent = article.title || '';
    }
    
    // Set meta description if available
    const metaEl = document.getElementById('blog-detail-meta');
    if (metaEl && article.meta_description) {
        metaEl.innerHTML = `<p class="blog-detail-meta-description">${escapeHtml(article.meta_description)}</p>`;
    }
    
    // Set featured image
    const imageContainer = document.getElementById('blog-detail-image-container');
    const imageEl = document.getElementById('blog-detail-image');
    if (article.image_url && imageContainer && imageEl) {
        imageEl.src = article.image_url;
        imageEl.alt = article.title || 'Article image';
        imageContainer.style.display = 'block';
    } else if (imageContainer) {
        imageContainer.style.display = 'none';
    }
    
    // Set content
    const bodyEl = document.getElementById('blog-detail-body');
    if (bodyEl && article.content_html) {
        bodyEl.innerHTML = article.content_html;
    }
    
    // Set tags
    const tagsEl = document.getElementById('blog-detail-tags');
    if (tagsEl && article.tags && article.tags.length > 0) {
        tagsEl.innerHTML = `
            <div class="blog-detail-tags-label">Tags:</div>
            <div class="blog-detail-tags-list">
                ${article.tags.map(tag => `<span class="blog-tag">${escapeHtml(tag)}</span>`).join('')}
            </div>
        `;
        tagsEl.style.display = 'flex';
    } else if (tagsEl) {
        tagsEl.style.display = 'none';
    }
    
    // Update page title
    if (article.title) {
        document.title = `${article.title} - Blog`;
    }
}

/**
 * Show detail loading state
 */
function showDetailLoading() {
    const loading = document.getElementById('blog-detail-loading');
    if (loading) loading.style.display = 'flex';
}

/**
 * Hide detail loading state
 */
function hideDetailLoading() {
    const loading = document.getElementById('blog-detail-loading');
    if (loading) loading.style.display = 'none';
}

/**
 * Show detail error state
 * @param {string} message - Error message
 */
function showDetailError(message) {
    const error = document.getElementById('blog-detail-error');
    const errorMessage = document.getElementById('blog-detail-error-message');
    if (error) error.style.display = 'block';
    if (errorMessage) errorMessage.textContent = message;
}

/**
 * Hide detail error state
 */
function hideDetailError() {
    const error = document.getElementById('blog-detail-error');
    if (error) error.style.display = 'none';
}

/**
 * Show detail content
 */
function showDetailContent() {
    const content = document.getElementById('blog-detail-content');
    if (content) content.style.display = 'block';
}

/**
 * Hide detail content
 */
function hideDetailContent() {
    const content = document.getElementById('blog-detail-content');
    if (content) content.style.display = 'none';
}

