/**
 * LIVA Botanical Skincare - Bilingual Translation System (English & Khmer)
 * Supports dynamic switching on both live Laravel backend & static GitHub Pages.
 */
(function (window) {
    'use strict';

    var TRANSLATIONS = {
        en: {
            // Topbar & Header
            free_shipping: 'Free Botanical Shipping for all Orders over $50',
            home: 'Home',
            shop: 'Shop',
            pages: 'Pages',
            blog: 'Blog',
            contact: 'Contact',
            botanical_shop: 'Botanical Shop',
            shopping_bag: 'Shopping Bag',
            checkout: 'Check Out',
            skincare_journal: 'Skincare Journal',
            login: 'Login',
            register: 'Register',
            logout: 'Logout',
            bag_label: 'bag:',
            support_time: 'support 24/7 time',

            // Brand & Search
            brand_tagline: 'Botanical Skincare',
            search_placeholder: 'Search botanical skincare, hair care, oils...',
            search_btn: 'SEARCH',
            all_departments: 'All departments',

            // Hero
            organic_badge: '100% ORGANIC',
            hero_title: 'Botanical & Pure Skincare',
            hero_subtitle: 'Free Pickup and Delivery Available',
            shop_now: 'SHOP NOW',

            // Categories & Filters
            hair_care: 'Hair Care',
            conditioner: 'Conditioner',
            hair_mask: 'Hair Mask',
            body_wash: 'Body Wash',
            body_lotion: 'Body Lotion',
            facial_care: 'Facial Care',
            rituals_sets: 'Rituals & Sets',
            featured_title: 'Featured Botanicals',
            filter_all: 'All',
            filter_hair: 'Hair Care',
            filter_body: 'Body Care',
            filter_facial: 'Facial Care',
            filter_sets: 'Sets & Bundles',

            // Product Cards & Cart
            add_to_cart: 'Add to Bag',
            added_to_cart: 'Added to your bag!',
            view_bag: 'View Bag & Checkout →',
            cart_empty: 'Your shopping bag is empty',
            subtotal: 'Subtotal',
            total: 'Total',
            price: 'Price',
            quantity: 'Quantity',
            proceed_checkout: 'PROCEED TO CHECKOUT',
            continue_shopping: 'CONTINUE SHOPPING',
            clear_bag: 'CLEAR BAG',

            // Auth (Login / Register)
            customer_login: 'Customer Login',
            welcome_back: 'Welcome Back',
            login_subtitle: 'Sign in to your LIVA Botanical account',
            join_title: 'Join LIVA Botanical',
            join_subtitle: 'Unlock personalized skincare rituals & member perks',
            login_google: 'Continue with Google',
            login_facebook: 'Continue with Facebook',
            or_email: 'or continue with email',
            email_address: 'Email Address',
            password: 'Password',
            remember_me: 'Remember me',
            forgot_password: 'Forgot Password?',
            sign_in: 'SIGN IN',
            no_account: "Don't have an account yet?",
            create_one: 'Create one here',
            full_name: 'Full Name',
            confirm_password: 'Confirm Password',
            create_account: 'CREATE ACCOUNT',
            have_account: 'Already have an account?',
            sign_in_here: 'Sign in here',

            // Footer
            useful_links: 'Useful Links',
            about_us: 'About Us',
            about_shop: 'About Our Shop',
            secure_shopping: 'Secure Shopping',
            delivery_info: 'Delivery information',
            privacy_policy: 'Privacy Policy',
            our_sitemap: 'Our Sitemap',
            newsletter_title: 'Join Our Newsletter Now',
            newsletter_desc: 'Get E-mail updates about our latest shop and special offers.',
            enter_email: 'Enter your mail',
            subscribe: 'Subscribe',
            all_rights: 'All rights reserved'
        },
        km: {
            // Topbar & Header
            free_shipping: 'ដឹកជញ្ជូនឥតគិតថ្លៃសម្រាប់ការបញ្ជាទិញចាប់ពី $50 ឡើងទៅ',
            home: 'ទំព័រដើម',
            shop: 'ហាងទំនិញ',
            pages: 'ទំព័រផ្សេងៗ',
            blog: 'អត្ថបទ',
            contact: 'ទំនាក់ទំនង',
            botanical_shop: 'ហាងផលិតផលធម្មជាតិ',
            shopping_bag: 'កន្ត្រកទំនិញ',
            checkout: 'គិតលុយ',
            skincare_journal: 'កំណត់ហេតុថែរក្សាស្បែក',
            login: 'ចូលគណនី',
            register: 'ចុះឈ្មោះ',
            logout: 'ចាកចេញ',
            bag_label: 'កន្ត្រក:',
            support_time: 'សេវាបម្រើអតិថិជន 24/7',

            // Brand & Search
            brand_tagline: 'ផលិតផលថែរក្សាស្បែកធម្មជាតិ',
            search_placeholder: 'ស្វែងរកផលិតផលថែរក្សាស្បែក, សក់, ប្រេងធម្មជាតិ...',
            search_btn: 'ស្វែងរក',
            all_departments: 'ប្រភេទទំនិញទាំងអស់',

            // Hero
            organic_badge: 'ធម្មជាតិ ១០០%',
            hero_title: 'ផលិតផលថែរក្សាស្បែកធម្មជាតិសុទ្ធសាធ',
            hero_subtitle: 'មានសេវាទទួល និងដឹកជញ្ជូនរហ័សទាន់ចិត្ត',
            shop_now: 'ទិញឥឡូវនេះ',

            // Categories & Filters
            hair_care: 'ថែរក្សាសក់',
            conditioner: 'ក្រែមបន្ទន់សក់',
            hair_mask: 'ម៉ាសបំប៉នសក់',
            body_wash: 'សាប៊ូដុសខ្លួន',
            body_lotion: 'ឡេលាបខ្លួន',
            facial_care: 'ថែរក្សាផ្ទៃមុខ',
            rituals_sets: 'ឈុតថែរក្សាសម្រស់',
            featured_title: 'ផលិតផលធម្មជាតិពេញនិយម',
            filter_all: 'ទាំងអស់',
            filter_hair: 'ថែរក្សាសក់',
            filter_body: 'ថែរក្សាដងខ្លួន',
            filter_facial: 'ថែរក្សាផ្ទៃមុខ',
            filter_sets: 'ឈុតផលិតផល',

            // Product Cards & Cart
            add_to_cart: 'បញ្ចូលទៅកន្ត្រក',
            added_to_cart: 'បានបញ្ចូលទៅកន្ត្រកហើយ!',
            view_bag: 'មើលកន្ត្រក និងទូទាត់ប្រាក់ →',
            cart_empty: 'កន្ត្រកទំនិញរបស់អ្នកទទេ',
            subtotal: 'សរុបរង',
            total: 'សរុបរួម',
            price: 'តម្លៃ',
            quantity: 'ចំនួន',
            proceed_checkout: 'បន្តទៅការទូទាត់ប្រាក់',
            continue_shopping: 'បន្តទិញទំនិញ',
            clear_bag: 'សម្អាតកន្ត្រក',

            // Auth (Login / Register)
            customer_login: 'ចូលគណនីអតិថិជន',
            welcome_back: 'សូមស្វាគមន៍ការត្រឡប់មកវិញ',
            login_subtitle: 'ចូលទៅក្នុងគណនី LIVA Botanical របស់អ្នក',
            join_title: 'ចូលរួមជាមួយ LIVA Botanical',
            join_subtitle: 'ទទួលបានការថែរក្សាស្បែកផ្ទាល់ខ្លួន និងអត្ថប្រយោជន៍សមាជិក',
            login_google: 'បន្តជាមួយ Google',
            login_facebook: 'បន្តជាមួយ Facebook',
            or_email: 'ឬបន្តជាមួយអ៊ីមែល',
            email_address: 'អាសយដ្ឋានអ៊ីមែល',
            password: 'ពាក្យសម្ងាត់',
            remember_me: 'ចងចាំខ្ញុំ',
            forgot_password: 'ភ្លេចពាក្យសម្ងាត់?',
            sign_in: 'ចូលគណនី',
            no_account: 'មិនទាន់មានគណនីមែនទេ?',
            create_one: 'ចុះឈ្មោះនៅទីនេះ',
            full_name: 'ឈ្មោះពេញ',
            confirm_password: 'បញ្ជាក់ពាក្យសម្ងាត់',
            create_account: 'បង្កើតគណនី',
            have_account: 'មានគណនីរួចហើយមែនទេ?',
            sign_in_here: 'ចូលគណនីនៅទីនេះ',

            // Footer
            useful_links: 'តំណភ្ជាប់មានប្រយោជន៍',
            about_us: 'អំពីយើង',
            about_shop: 'អំពីហាងយើង',
            secure_shopping: 'ការទិញទំនិញប្រកបដោយសុវត្ថិភាព',
            delivery_info: 'ព័ត៌មានដឹកជញ្ជូន',
            privacy_policy: 'គោលការណ៍ភាពឯកជន',
            our_sitemap: 'ប្លង់គេហទំព័រ',
            newsletter_title: 'ជាវព្រឹត្តិបត្រព័ត៌មានឥឡូវនេះ',
            newsletter_desc: 'ទទួលបានព័ត៌មានថ្មីៗ និងការផ្តល់ជូនពិសេសពីហាងរបស់យើង។',
            enter_email: 'បញ្ចូលអ៊ីមែលរបស់អ្នក',
            subscribe: 'ជាវឥឡូវនេះ',
            all_rights: 'រក្សាសិទ្ធិគ្រប់យ៉ាង'
        }
    };

    function getCurrentLanguage() {
        var saved = localStorage.getItem('liva_app_language');
        return saved === 'km' ? 'km' : 'en';
    }

    function setAppLanguage(lang) {
        if (lang !== 'en' && lang !== 'km') {
            lang = 'en';
        }

        localStorage.setItem('liva_app_language', lang);
        document.documentElement.lang = lang;

        if (lang === 'km') {
            document.body.classList.add('lang-km');
        } else {
            document.body.classList.remove('lang-km');
        }

        // Update language indicator in headers
        var currentLabels = document.querySelectorAll('.js-current-lang-label');
        currentLabels.forEach(function (el) {
            el.innerHTML = lang === 'km' ? '🇰🇭 ភាសាខ្មែរ' : '🇬🇧 English';
        });

        // Translate text elements
        var dict = TRANSLATIONS[lang] || TRANSLATIONS.en;
        var elements = document.querySelectorAll('[data-i18n]');
        elements.forEach(function (el) {
            var key = el.getAttribute('data-i18n');
            if (key && dict[key] !== undefined) {
                el.textContent = dict[key];
            }
        });

        // Translate input placeholders
        var inputs = document.querySelectorAll('[data-i18n-placeholder]');
        inputs.forEach(function (input) {
            var key = input.getAttribute('data-i18n-placeholder');
            if (key && dict[key] !== undefined) {
                input.setAttribute('placeholder', dict[key]);
            }
        });

        // Dispatch language change event for other components
        window.dispatchEvent(new CustomEvent('liva:languageChanged', { detail: { lang: lang } }));

        // If running in live Laravel (not static GitHub Pages), notify server
        if (window.location.hostname.indexOf('github.io') === -1) {
            fetch('/lang/' + lang, { credentials: 'same-origin' }).catch(function () {});
        }
    }

    // Expose globally
    window.LivaI18n = {
        translations: TRANSLATIONS,
        get: function (key, fallback) {
            var lang = getCurrentLanguage();
            return (TRANSLATIONS[lang] && TRANSLATIONS[lang][key]) || fallback || key;
        },
        getCurrentLanguage: getCurrentLanguage,
        setLanguage: setAppLanguage
    };
    window.setAppLanguage = setAppLanguage;

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            setAppLanguage(getCurrentLanguage());
        });
    } else {
        setAppLanguage(getCurrentLanguage());
    }
}(window));
