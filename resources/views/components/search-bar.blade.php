{{-- Search Bar Component --}}
<div class="search-bar-container w-full mb-8">
    <form 
        action="{{ url(Config::get('app.locale') . '/' . __('url.search')) }}" 
        method="GET" 
        class="w-full"
    >
        <div class="relative w-full">
            {{-- Search Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg 
                    class="w-5 h-5 text-gray-500 dark:text-gray-400" 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                >
                    <circle cx="11" cy="11" r="8" stroke-width="2"/>
                    <path d="m21 21-4.35-4.35" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>

            {{-- Search Input --}}
            <input 
                type="text" 
                name="q" 
                id="search-input"
                data-search-autocomplete
                data-locale="{{ Config::get('app.locale') }}"
                placeholder="{{ __('text.search-placeholder') }}"
                autocomplete="off"
                class="w-full pl-12 pr-12 py-4 text-base rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-secondary-light text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                aria-label="{{ __('text.search-placeholder') }}"
                aria-expanded="false"
                aria-autocomplete="list"
                aria-controls="search-suggestions"
            />

            {{-- Clear Button (shown when input has value) --}}
            <button 
                type="button" 
                id="search-clear-btn"
                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors duration-200 hidden"
                aria-label="Clear search"
                onclick="document.getElementById('search-input').value = ''; document.getElementById('search-input').focus(); this.classList.add('hidden');"
            >
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        {{-- Suggestions container will be injected here by JS --}}
    </form>

    {{-- Bang Hint Text --}}
    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 text-center">
        {!! __('text.search-with-bangs') !!}
    </p>
</div>

{{-- Styles for search suggestions --}}
<style>
    .search-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        margin-top: 0.5rem;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.2s ease;
        z-index: 50;
    }

    .dark .search-suggestions {
        background: #1E1E21;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .search-suggestions.show {
        max-height: 400px;
        overflow-y: auto;
        opacity: 1;
    }

    .search-suggestion-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        cursor: pointer;
        transition: background-color 0.15s ease;
        min-height: 44px; /* Touch-friendly */
    }

    .search-suggestion-item:hover,
    .search-suggestion-item.selected {
        background-color: #F3F4F6;
    }

    .dark .search-suggestion-item:hover,
    .dark .search-suggestion-item.selected {
        background-color: #4B4B50;
    }

    .search-suggestion-item:first-child {
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .search-suggestion-item:last-child {
        border-radius: 0 0 0.5rem 0.5rem;
    }

    .search-suggestion-icon {
        flex-shrink: 0;
        color: #6B7280;
    }

    .dark .search-suggestion-icon {
        color: #9CA3AF;
    }

    .search-suggestion-text {
        flex: 1;
        font-size: 0.875rem;
        color: #1F2937;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .dark .search-suggestion-text {
        color: #F3F4F6;
    }

    .bang-highlight {
        color: #E2232A;
        font-weight: 600;
    }

    .dark .bang-highlight {
        color: #F06B71;
    }

    /* Show clear button when input has value */
    #search-input:not(:placeholder-shown) ~ #search-clear-btn {
        display: flex;
    }

    /* Smooth scrollbar for suggestions */
    .search-suggestions::-webkit-scrollbar {
        width: 8px;
    }

    .search-suggestions::-webkit-scrollbar-track {
        background: transparent;
    }

    .search-suggestions::-webkit-scrollbar-thumb {
        background: #D1D5DB;
        border-radius: 4px;
    }

    .dark .search-suggestions::-webkit-scrollbar-thumb {
        background: #4B4B50;
    }

    /* Animation for search bar */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .search-bar-container {
        animation: fadeInUp 0.4s ease-out;
    }
</style>

{{-- Script for clear button toggle --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const clearBtn = document.getElementById('search-clear-btn');
        
        if (searchInput && clearBtn) {
            searchInput.addEventListener('input', function() {
                if (this.value.length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                }
            });
        }
    });
</script>
