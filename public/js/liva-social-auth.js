/**
 * LIVA Botanical Skincare - Social Auth Handler (Google & Facebook)
 * Works seamlessly on live Laravel authentication and provides interactive simulation on GitHub Pages.
 */
(function (window) {
    'use strict';

    var STORAGE_KEY = 'liva_customer_auth';

    function isStaticPreview() {
        return window.location.hostname.indexOf('github.io') !== -1;
    }

    function getAuthUser() {
        try {
            var raw = localStorage.getItem(STORAGE_KEY);
            return raw ? JSON.parse(raw) : null;
        } catch (e) {
            return null;
        }
    }

    function setAuthUser(user) {
        try {
            if (user) {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(user));
            } else {
                localStorage.removeItem(STORAGE_KEY);
            }
        } catch (e) {}
    }

    function syncAuthUI() {
        var user = getAuthUser();
        var authContainers = document.querySelectorAll('.header__top__right__auth');

        if (!authContainers.length) return;

        authContainers.forEach(function (container) {
            // Only update dynamically if there is no backend authenticated user or if on static host
            if (isStaticPreview() || !container.querySelector('.dropdown-toggle')) {
                if (user) {
                    var providerIcon = user.provider === 'facebook' ? 'fa-facebook-official text-primary' : 'fa-google text-danger';
                    container.innerHTML =
                        '<div class="dropdown" style="display:inline-block;">' +
                        '  <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #1c1c1c; font-weight: 600; display: inline-block;">' +
                        '    <i class="fa ' + providerIcon + ' mr-1"></i> ' + user.name +
                        '  </a>' +
                        '  <div class="dropdown-menu dropdown-menu-right" style="font-size: 14px; min-width: 140px; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">' +
                        '    <a href="javascript:void(0)" class="dropdown-item js-social-logout" style="cursor: pointer; color: #dc3545; padding: 8px 16px;">' +
                        '      <i class="fa fa-sign-out mr-1"></i> Logout' +
                        '    </a>' +
                        '  </div>' +
                        '</div>';
                }
            }
        });

        // Attach logout listeners
        document.querySelectorAll('.js-social-logout').forEach(function (btn) {
            btn.onclick = function (e) {
                e.preventDefault();
                setAuthUser(null);
                window.location.reload();
            };
        });
    }

    function initSocialButtons() {
        document.querySelectorAll('.social-btn-google, .social-btn-facebook').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                if (isStaticPreview()) {
                    e.preventDefault();
                    var isGoogle = btn.classList.contains('social-btn-google');
                    var provider = isGoogle ? 'google' : 'facebook';
                    var providerName = isGoogle ? 'Google' : 'Facebook';

                    var mockUser = {
                        name: providerName + ' Member',
                        email: 'member@' + provider + '.com',
                        provider: provider
                    };

                    setAuthUser(mockUser);

                    if (window.showCartToast) {
                        window.showCartToast('<div><strong>✓ Successfully signed in with ' + providerName + '!</strong></div>', false);
                    } else {
                        alert('Successfully signed in with ' + providerName + '!');
                    }

                    setTimeout(function () {
                        var returnUrl = window.location.pathname.indexOf('/login') !== -1 || window.location.pathname.indexOf('/register') !== -1
                            ? window.location.pathname.replace(/\/login|\/register/, '') || './'
                            : window.location.href;
                        window.location.href = returnUrl;
                    }, 500);
                }
            });
        });
    }

    // Expose helpers
    window.LivaSocialAuth = {
        getUser: getAuthUser,
        setUser: setAuthUser,
        syncUI: syncAuthUI
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            syncAuthUI();
            initSocialButtons();
        });
    } else {
        syncAuthUI();
        initSocialButtons();
    }
}(window));
