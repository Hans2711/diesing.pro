document.addEventListener("DOMContentLoaded", () => {
    const STORAGE_KEY = "zen_quotes";
    const MAX_QUOTES = 10;

    const loadQuotesFromStorage = () => {
        try {
            const stored = localStorage.getItem(STORAGE_KEY);
            return stored ? JSON.parse(stored) : [];
        } catch {
            return [];
        }
    };

    const saveQuotesToStorage = (quotes) => {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(quotes.slice(0, MAX_QUOTES)));
        } catch (e) {
            console.warn("Could not save to localStorage:", e);
        }
    };

    const displayQuote = (quoteObj) => {
        document.querySelector(".zen-wrapper").textContent =
            `"${quoteObj.quote}" — ${quoteObj.author}`;
    };

    const fetchNewQuote = () => {
        return fetch("/quote/rand")
            .then(res => res.json())
            .then(data => {
                if (data.quote && data.author) {
                    return { quote: data.quote, author: data.author };
                }
                throw new Error("Invalid quote data");
            });
    };

    const initQuote = async () => {
        const savedQuotes = loadQuotesFromStorage();

        const useSaved = savedQuotes.length >= MAX_QUOTES && Math.random() < 0.5;

        if (useSaved) {
            const random = savedQuotes[Math.floor(Math.random() * savedQuotes.length)];
            displayQuote(random);
        } else {
            try {
                const newQuote = await fetchNewQuote();
                displayQuote(newQuote);

                const alreadyExists = savedQuotes.some(
                    q => q.quote === newQuote.quote && q.author === newQuote.author
                );
                if (!alreadyExists) {
                    savedQuotes.unshift(newQuote); // newest on top
                    saveQuotesToStorage(savedQuotes);
                }
            } catch (err) {
                console.error("Failed to fetch quote:", err);
                if (savedQuotes.length > 0) {
                    const fallback = savedQuotes[Math.floor(Math.random() * savedQuotes.length)];
                    displayQuote(fallback);
                } else {
                }
            }
        }
    };

    initQuote();
});
