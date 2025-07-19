<footer class="site-footer section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 mb-4 pb-2">
                <a class="navbar-brand" href="/">
                    <i class="bi-mortarboard text-white"></i>
                    <span class="text-white">eMock.uz</span>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <h6 class="site-footer-title mb-3">{{ __('messages.resources') }}</h6>
                <ul class="site-footer-links">
                    <li class="site-footer-link-item">
                        <a href="/" class="site-footer-link">{{ __('messages.home') }}</a>
                    </li>
                    <li class="site-footer-link-item">
                        <a href="/#section_3" class="site-footer-link">{{ __('messages.how_it_works') }}</a>
                    </li>
                    <li class="site-footer-link-item">
                        <a href="/#section_4" class="site-footer-link">{{ __('messages.faqs') }}</a>
                    </li>
                    <li class="site-footer-link-item">
                        <a href="/#section_5" class="site-footer-link">{{ __('messages.contact_title') }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                <h6 class="site-footer-title mb-3">{{ __('messages.contact_title') }}</h6>
                <p class="text-white d-flex mb-1">
                    <a href="https://t.me/eMock_support" class="site-footer-link">@eMock_support</a>
                </p>
                <p class="text-white d-flex">
                    <a href="mailto:support@emock.uz" class="site-footer-link">
                        support@emock.uz
                    </a>
                </p>
            </div>
            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                <h6 class="site-footer-title mb-3">{{ __('messages.disclaimer') }}</h6>
                <p class="copyright-text">{{ __('messages.footer_disclaimer') }}
                    <a href="mailto:support@emock.uz" class="site-footer-link">support@emock.uz</a>
                </p>
                <ul class="site-footer-links mt-3">
                    <li class="site-footer-link-item"><a href="/privacy"
                            class="site-footer-link">{{ __('messages.link_privacy_policy') }}</a></li>
                    <li class="site-footer-link-item"><a href="/terms"
                            class="site-footer-link">{{ __('messages.link_terms_of_service') }}</a></li>
                    <li class="site-footer-link-item"><a href="/cookies"
                            class="site-footer-link">{{ __('messages.link_cookies_policy') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="custom-overlay"></div>
</footer>
<!-- Cookie Consent Banner -->
<div id="cookie-consent-banner" class="cookie-consent-form">
    <div style="flex:1;">
        <strong>We use cookies</strong><br>
        This website uses cookies to ensure you get the best experience. <a href="/cookies"
            style="color:#4fd1c5;text-decoration:underline;">Learn more</a>
    </div>
    <button id="cookie-consent-accept"
        style="background:#4fd1c5;color:#181a20;border:none;border-radius:8px;padding:8px 18px;font-weight:600;cursor:pointer;">Accept</button>
</div>
<script>
    // Cookie Consent Logic
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    document.addEventListener('DOMContentLoaded', function() {
        if (!getCookie('cookie_consent')) {
            document.getElementById('cookie-consent-banner').style.display = 'flex';
        }
        document.getElementById('cookie-consent-accept').onclick = function() {
            setCookie('cookie_consent', 'accepted', 365);
            document.getElementById('cookie-consent-banner').style.display = 'none';
        };
    });

    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        document.body.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        document.getElementById('theme-toggle-icon').className = theme === 'dark' ? 'bi-sun' : 'bi-moon';
    }

    function getPreferredTheme() {
        return localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
            'light');
    }
    document.addEventListener('DOMContentLoaded', function() {
        setTheme(getPreferredTheme());
        document.getElementById('theme-toggle').addEventListener('click', function() {
            const current = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' :
                'light';
            setTheme(current === 'dark' ? 'light' : 'dark');
        });
    });
</script>
