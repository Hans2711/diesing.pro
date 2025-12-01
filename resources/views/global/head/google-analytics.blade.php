@if (env('APP_ENV') == 'production')
    <!-- Google tag (gtag.js) - Async loaded for performance -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-SX1DCPHNNB');
        
        // Load gtag script asynchronously
        (function() {
            var script = document.createElement('script');
            script.src = 'https://www.googletagmanager.com/gtag/js?id=G-SX1DCPHNNB';
            script.async = true;
            document.head.appendChild(script);
        })();
    </script>
@endif
