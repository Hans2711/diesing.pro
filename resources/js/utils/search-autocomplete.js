/**
 * Google Search Autocomplete
 * 
 * Provides real-time search suggestions using Google's autocomplete API
 * Features:
 * - Debounced input to minimize API calls
 * - Keyboard navigation (up/down/enter/escape)
 * - Mouse interaction support
 * - ARIA accessibility attributes
 * - Mobile responsive
 */

class SearchAutocomplete {
    constructor(inputElement) {
        this.input = inputElement;
        this.locale = inputElement.dataset.locale || 'en';
        this.suggestions = [];
        this.selectedIndex = -1;
        this.debounceTimer = null;
        this.suggestionsContainer = null;
        this.isLoading = false;
        
        this.init();
    }

    init() {
        // Create suggestions dropdown container
        this.createSuggestionsContainer();
        
        // Bind event listeners
        this.input.addEventListener('input', (e) => this.handleInput(e));
        this.input.addEventListener('keydown', (e) => this.handleKeyDown(e));
        this.input.addEventListener('focus', () => this.handleFocus());
        this.input.addEventListener('blur', (e) => this.handleBlur(e));
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!this.input.contains(e.target) && !this.suggestionsContainer.contains(e.target)) {
                this.hideSuggestions();
            }
        });
        
        // Close dropdown on scroll (mobile UX)
        window.addEventListener('scroll', () => {
            if (this.suggestionsContainer.classList.contains('show')) {
                this.hideSuggestions();
            }
        });
    }

    createSuggestionsContainer() {
        const container = document.createElement('div');
        container.className = 'search-suggestions';
        container.setAttribute('role', 'listbox');
        container.setAttribute('aria-label', 'Search suggestions');
        
        // Insert after input's parent
        this.input.parentElement.appendChild(container);
        this.suggestionsContainer = container;
    }

    handleInput(e) {
        const query = e.target.value.trim();
        
        // Clear previous timer
        if (this.debounceTimer) {
            clearTimeout(this.debounceTimer);
        }
        
        // Hide suggestions if query is empty
        if (query.length === 0) {
            this.hideSuggestions();
            return;
        }
        
        // Debounce: Wait 300ms after user stops typing
        this.debounceTimer = setTimeout(() => {
            this.fetchSuggestions(query);
        }, 300);
    }

    handleKeyDown(e) {
        // Only handle if suggestions are visible
        if (!this.suggestionsContainer.classList.contains('show')) {
            return;
        }

        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.selectNext();
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.selectPrevious();
                break;
            case 'Enter':
                e.preventDefault();
                this.submitSelected();
                break;
            case 'Escape':
                e.preventDefault();
                this.hideSuggestions();
                this.input.blur();
                break;
            case 'Tab':
                this.hideSuggestions();
                break;
        }
    }

    handleFocus() {
        // Show suggestions if we have them and input has value
        if (this.suggestions.length > 0 && this.input.value.trim().length > 0) {
            this.showSuggestions();
        }
    }

    handleBlur(e) {
        // Delay hiding to allow clicking on suggestions
        setTimeout(() => {
            if (!this.suggestionsContainer.contains(document.activeElement)) {
                this.hideSuggestions();
            }
        }, 200);
    }

    fetchSuggestions(query) {
        // Use JSONP to bypass CORS
        const callbackName = `searchSuggest_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
        
        // Create script element
        const script = document.createElement('script');
        script.id = callbackName;
        
        // Define callback
        window[callbackName] = (data) => {
            // data format: ["query", ["suggestion1", "suggestion2", ...]]
            if (data && data[1] && Array.isArray(data[1])) {
                this.suggestions = data[1];
                this.displaySuggestions();
            }
            
            // Cleanup
            delete window[callbackName];
            const scriptElement = document.getElementById(callbackName);
            if (scriptElement) {
                scriptElement.remove();
            }
        };
        
        // Set timeout to clean up if request fails
        setTimeout(() => {
            if (window[callbackName]) {
                delete window[callbackName];
                const scriptElement = document.getElementById(callbackName);
                if (scriptElement) {
                    scriptElement.remove();
                }
            }
        }, 5000);
        
        // Make request
        const encodedQuery = encodeURIComponent(query);
        script.src = `https://suggestqueries.google.com/complete/search?client=firefox&q=${encodedQuery}&callback=${callbackName}`;
        document.head.appendChild(script);
    }

    displaySuggestions() {
        // Clear previous suggestions
        this.suggestionsContainer.innerHTML = '';
        this.selectedIndex = -1;
        
        if (this.suggestions.length === 0) {
            this.hideSuggestions();
            return;
        }
        
        // Limit suggestions based on screen size
        const isMobile = window.innerWidth < 768;
        const maxSuggestions = isMobile ? 5 : 8;
        const displaySuggestions = this.suggestions.slice(0, maxSuggestions);
        
        // Create suggestion items
        displaySuggestions.forEach((suggestion, index) => {
            const item = document.createElement('div');
            item.className = 'search-suggestion-item';
            item.setAttribute('role', 'option');
            item.setAttribute('data-index', index);
            
            // Highlight bang triggers
            const formattedText = this.formatSuggestion(suggestion);
            item.innerHTML = `
                <svg class="search-suggestion-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <span class="search-suggestion-text">${formattedText}</span>
            `;
            
            // Mouse events
            item.addEventListener('mouseenter', () => {
                this.selectItem(index);
            });
            
            item.addEventListener('click', (e) => {
                e.preventDefault();
                this.input.value = suggestion;
                this.submitForm();
            });
            
            this.suggestionsContainer.appendChild(item);
        });
        
        this.showSuggestions();
    }

    formatSuggestion(text) {
        // Escape HTML first
        const escaped = text.replace(/[&<>"']/g, (char) => {
            const escapeMap = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            };
            return escapeMap[char];
        });
        
        // Highlight bang triggers (starts with ! and followed by word characters)
        return escaped.replace(/(^|\s)(![\w]+)/g, '$1<span class="bang-highlight">$2</span>');
    }

    selectNext() {
        if (this.suggestions.length === 0) return;
        
        this.selectedIndex = Math.min(this.selectedIndex + 1, this.suggestions.length - 1);
        this.updateSelection();
    }

    selectPrevious() {
        if (this.suggestions.length === 0) return;
        
        this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
        this.updateSelection();
    }

    selectItem(index) {
        this.selectedIndex = index;
        this.updateSelection();
    }

    updateSelection() {
        // Remove previous selection
        const items = this.suggestionsContainer.querySelectorAll('.search-suggestion-item');
        items.forEach(item => item.classList.remove('selected'));
        
        // Update ARIA
        if (this.selectedIndex >= 0 && items[this.selectedIndex]) {
            items[this.selectedIndex].classList.add('selected');
            this.input.setAttribute('aria-activedescendant', `suggestion-${this.selectedIndex}`);
            
            // Update input value with selected suggestion
            this.input.value = this.suggestions[this.selectedIndex];
            
            // Scroll into view if needed
            items[this.selectedIndex].scrollIntoView({ block: 'nearest' });
        } else {
            this.input.removeAttribute('aria-activedescendant');
        }
    }

    submitSelected() {
        if (this.selectedIndex >= 0 && this.suggestions[this.selectedIndex]) {
            this.input.value = this.suggestions[this.selectedIndex];
        }
        this.submitForm();
    }

    submitForm() {
        this.hideSuggestions();
        this.input.form.submit();
    }

    showSuggestions() {
        this.suggestionsContainer.classList.add('show');
        this.input.setAttribute('aria-expanded', 'true');
    }

    hideSuggestions() {
        this.suggestionsContainer.classList.remove('show');
        this.input.setAttribute('aria-expanded', 'false');
        this.selectedIndex = -1;
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    const searchInputs = document.querySelectorAll('[data-search-autocomplete]');
    searchInputs.forEach(input => {
        new SearchAutocomplete(input);
    });
});

export default SearchAutocomplete;
