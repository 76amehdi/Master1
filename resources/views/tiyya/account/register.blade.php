<head><title>
    register
</title></head>
<body>
   
    <style>
        .section-header__title {
            text-align: center;
            font-size: 2.5em;
        }

        /* Import Font */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap');

        /* Style for H1 */
        .section-header__title {
            text-align: center;
            /* Center the text */
            font-family: 'Tenor Sans', sans-serif;
            /* Rounded, clean font */
            font-size: 45px;
            /* Moderate size */
            font-weight: 400;
            /* Medium weight for boldness */
            text-transform: uppercase;
            /* Converts text to uppercase */
            letter-spacing: 0.0em;
            /* Slight spacing for clarity */
            line-height: 1.1;
            /* Adds line height for readability */
            margin: 0;
            /* Removes default margin */
        }
    </style>

    @extends('tiyya.index')
    @section('content')
        <a class="in-page-link visually-hidden skip-link" href="#MainContent">@lang('register.skip_to_content')</a>

        <div id="PageContainer" class="page-container">
            <div class="transition-body">

                <div >
                    <div class="page-width page-width--tiny page-content">
                        <header class="section-header">
                            <h1 class="section-header__title">@lang('register.register')</h1>
                        </header>

                        <div class="note note--success hide" id="ResetSuccess">
                            @lang('register.reset_success_message')
                        </div>

                        <div id="CustomerLoginForm" class="form-vertical">
                            <form method="post" action="{{ route('register',['lang' => app()->getLocale()]) }}" id="customer_login" accept-charset="UTF-8"
                                data-login-with-shop-sign-in="true">
                                
                                    @csrf

                                <label for="CustomerEmail">@lang('register.first_name')</label>
                                <input type="text" name="fname" id="CustomerEmail" class="input-full" autocorrect="off"
                                    autocapitalize="off" autofocus />
                                <label for="CustomerEmail">@lang('register.last_name')</label>
                                <input type="text" name="name" id="CustomerEmail" class="input-full" autocorrect="off"
                                    autocapitalize="off" autofocus />

                                <label for="CustomerEmail">@lang('register.email')</label>
                                <input type="email" name="email" id="CustomerEmail" class="input-full" autocorrect="off"
                                    autocapitalize="off" autofocus />
                                <div class="grid">
                                    <div class="grid__item one-half">
                                        <label for="password">@lang('register.password')</label>
                                    </div>

                                </div>
                                <input type="password" value="" name="password" id="password"
                                    class="input-full" />
                                <p>

                                    <button type="submit" class="btn btn--full">
                                        @lang('register.create')
                                    </button>
                            </form>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
        <div id="Shopshop-section-newsletter-popup" class="Shopshop-section index-section--hidden"></div>
        <div id="VideoModal" class="modal modal--solid">
            <div class="modal__inner">
                <div class="modal__centered page-width text-center">
                    <div class="modal__centered-content">
                        <div class="video-wrapper video-wrapper--modal">
                            <div id="VideoHolder"></div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="modal__close js-modal-close text-link">
                <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" viewBox="0 0 64 64">
                    <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74" />
                </svg>
                <span class="icon__fallback-text">"Fermer (Esc)"</span>
            </button>
        </div>
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <div class="pswp__ui pswp__ui--hidden">
                    <button class="btn btn--body btn--circle pswp__button pswp__button--arrow--left" title="Précédent">
                        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-chevron-left"
                            viewBox="0 0 284.49 498.98">
                            <path
                                d="M249.49 0a35 35 0 0 1 24.75 59.75L84.49 249.49l189.75 189.74a35.002 35.002 0 1 1-49.5 49.5L10.25 274.24a35 35 0 0 1 0-49.5L224.74 10.25A34.89 34.89 0 0 1 249.49 0z" />
                        </svg>
                    </button>

                    <button class="btn btn--body btn--circle btn--large pswp__button pswp__button--close"
                        title="Fermer (Esc)">
                        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close"
                            viewBox="0 0 64 64">
                            <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74" />
                        </svg>
                    </button>

                    <button class="btn btn--body btn--circle pswp__button pswp__button--arrow--right" title="Suivant">
                        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-chevron-right"
                            viewBox="0 0 284.49 498.98">
                            <path
                                d="M35 498.98a35 35 0 0 1-24.75-59.75l189.74-189.74L10.25 59.75a35.002 35.002 0 0 1 49.5-49.5l214.49 214.49a35 35 0 0 1 0 49.5L59.75 488.73A34.89 34.89 0 0 1 35 498.98z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <tool-tip data-tool-tip="">
            <div class="tool-tip__inner" data-tool-tip-inner>
                <button class="tool-tip__close" data-tool-tip-close="">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close"
                        viewBox="0 0 64 64">
                        <path d="M19 17.61l27.12 27.13m0-27.12L19 44.74" />
                    </svg>
                </button>
                <div class="tool-tip__content" data-tool-tip-content></div>
            </div>
        </tool-tip>
    @endsection
</body>