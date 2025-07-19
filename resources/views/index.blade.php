<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
        content="eMock.uz offers realistic free and paid computer-delivered IELTS mock exams to help you prepare confidently. Practice Listening, Reading, Writing, and Speaking under real test conditions.">
    <meta name="keywords"
        content="IELTS, IELTS mock test, IELTS mock exam, computer delivered IELTS, CD IELTS, IELTS practice test, free IELTS test, paid IELTS mock, IELTS online test, IELTS Listening practice, IELTS Reading practice, IELTS Writing practice, IELTS Speaking practice, full IELTS mock test, IELTS Uzbekistan, eMock.uz, IELTS simulation, IELTS band 9 preparation, academic IELTS test, general IELTS test, IELTS practice Uzbekistan, IELTS prep website, realistic IELTS mock, IELTS test with timer, IELTS result analysis, IELTS questions 2025, practice IELTS online free, official IELTS mock style, IELTS mock test Uzbekistan, IELTS exam preparation, IELTS timing simulator, IELTS with band score, IELTS test for students, IELTS home practice, IELTS full test experience, IELTS language skills test, IELTS platform Uzbekistan, mock IELTS platform, eMock.uz IELTS mock exams, best IELTS practice site">
    <meta name="author" content="eMock.uz Team">
    <meta name="robots" content="index, follow">
    <meta name="language" content="en">
    <meta name="revisit-after" content="3 days">
    <meta name="distribution" content="global">
    <meta name="rating" content="general">

    <title>eMock.uz – Practice IELTS Online with Real Mock Tests (CD Format)</title>

    <link rel="icon" href="{{ asset('src/icons/logo/emock-logo-no-bg-32.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('src/icons/apple/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('src/icons/favicon-circled-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('src/icons/favicon-circled-16.png') }}">

    <meta property="og:title" content="eMock.uz — Realistic IELTS Mock Exams">
    <meta property="og:description"
        content="Take full IELTS mock tests online, for free or paid, in real computer-delivered format.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://emock.uz/">
    <meta property="og:image" content="https://emock.uz/images/og-image.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="eMock.uz — Realistic IELTS Mock Exams">
    <meta name="twitter:description"
        content="Take IELTS Listening, Reading, Writing and Speaking mocks online — in real CD IELTS format.">
    <meta name="twitter:image" content="https://emock.uz/images/twitter-card.jpg">

    <link rel="canonical" href="https://emock.uz/" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link href="{{ asset('src/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('src/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('src/css/main.css') }}" rel="stylesheet">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "eMock.uz",
      "url": "https://emock.uz/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://emock.uz/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
</head>


<body id="top">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="bi-mortarboard text-white"></i>
                    <span class="text-white">eMock.uz</span>
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="/dashboard" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">{{ __('messages.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">{{ __('messages.mock_exams') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">{{ __('messages.how_it_works') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">{{ __('messages.faqs') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_5">{{ __('messages.feedback') }}</a>
                        </li>
                    </ul>

                    <div class="d-none d-lg-flex align-items-center gap-3">
                        <!-- Theme Toggle Button -->
                        <button id="theme-toggle"
                            class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
                            type="button" aria-label="Toggle dark mode">
                            <i id="theme-toggle-icon" class="bi bi-moon" style="font-size: 1.25rem;"></i>
                        </button>

                        <!-- Profile Icon -->
                        <button class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
                            aria-label="Profile" onclick="window.location.href='/dashboard'">
                            <i class="bi bi-person" style="font-size: 1.25rem;"></i>
                        </button>

                        <!-- Language Dropdown -->
                        <div class="dropdown">
                            <button class="btn dropdown-toggle d-flex align-items-center gap-2 px-3 py-1 rounded-pill"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $locale = session('locale', app()->getLocale());
                                    $flags = ['en' => 'gb', 'uz' => 'uz', 'ru' => 'ru'];
                                @endphp
                                <span class="fi fi-{{ $flags[$locale] ?? 'gb' }}"
                                    style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/{{ $flags[$locale] ?? 'gb' }}.svg');"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ route('lang.switch', ['lang' => 'uz']) }}">
                                        <span class="fi fi-uz"
                                            style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/uz.svg');"></span>
                                        O'zbek
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ route('lang.switch', ['lang' => 'ru']) }}">
                                        <span class="fi fi-ru"
                                            style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/ru.svg');"></span>
                                        Русский
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                        href="{{ route('lang.switch', ['lang' => 'en']) }}">
                                        <span class="fi fi-gb"
                                            style="width: 1.7em; height: 1.2em; background-size: cover; background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@6.7.0/flags/4x3/gb.svg');"></span>
                                        English
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <h1 class="text-white text-center">{{ __('messages.ielts_cd_mock_exams') }}</h1>
                        <h6 class="text-center">{{ __('messages.practice_all_skills') }}</h6>
                        <form method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bi-search" id="basic-addon1"></span>
                                <input name="keyword" type="search" class="form-control" id="keyword"
                                    placeholder="{{ __('messages.search_placeholder') }}" aria-label="Search">
                                <button type="submit" class="form-control">{{ __('messages.search') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <section class="featured-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block shadow-lg">
                            <a href="#section_2">
                                <div class="d-flex">
                                    <div>
                                        <h5 class="mb-2">{{ __('messages.free_ielts_mock') }}</h5>
                                        <p class="mb-0">{{ __('messages.free_ielts_mock_desc') }}</p>
                                    </div>
                                    <span class="badge bg-design rounded-pill ms-auto">free</span>
                                </div>
                                <img src="/src/images/ielts.jpg" class="custom-block-image img-fluid"
                                    alt="Free IELTS Mock">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="custom-block custom-block-overlay">
                            <div class="d-flex flex-column h-100">
                                <img src="/src/images/businesswoman-using-tablet-analysis.jpg"
                                    class="custom-block-image img-fluid" alt="">
                                <div class="custom-block-overlay-text d-flex">
                                    <div>
                                        <h5 class="text-white mb-2">{{ __('messages.premium_ielts_mock') }}</h5>
                                        <p class="text-white">{{ __('messages.premium_ielts_mock_desc') }}</p>
                                        <a href="#section_2"
                                            class="btn custom-btn mt-2 mt-lg-3">{{ __('messages.see_premium') }}</a>
                                    </div>
                                    <span class="badge bg-finance rounded-pill ms-auto">paid</span>
                                </div>
                                <div class="section-overlay"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="explore-section section-padding" id="section_2">
            <div class="container" style="min-height: 100px;">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="mb-4">{{ __('messages.mock_exams') }}</h2>
                        <p>{{ __('messages.choose_skill') }}</p>
                    </div>
                </div>
                <div class="row g-4 justify-content-center align-items-stretch" style="min-height: 100px;">
                    <div class="col-lg-3 col-md-6 col-12 d-flex">
                        <div class="custom-block flex-fill d-flex flex-column justify-content-between p-4 rounded shadow-sm"
                            style="min-height: 260px;">
                            <div>
                                <h5 class="mb-2">{{ __('messages.listening') }}</h5>
                                <p class="mb-3 small text-muted">{{ __('messages.listening_desc') }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-design rounded-pill">Skill</span>
                                <i class="bi bi-headphones icon-large"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 d-flex">
                        <div class="custom-block flex-fill d-flex flex-column justify-content-between p-4 rounded shadow-sm"
                            style="min-height: 260px;">
                            <div>
                                <h5 class="mb-2">{{ __('messages.reading') }}</h5>
                                <p class="mb-3 small text-muted">{{ __('messages.reading_desc') }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-design rounded-pill">Skill</span>
                                <i class="bi bi-book icon-large"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 d-flex">
                        <div class="custom-block flex-fill d-flex flex-column justify-content-between p-4 rounded shadow-sm"
                            style="min-height: 260px;">
                            <div>
                                <h5 class="mb-2">{{ __('messages.writing') }}</h5>
                                <p class="mb-3 small text-muted">{{ __('messages.writing_desc') }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-design rounded-pill">Skill</span>
                                <i class="bi bi-pencil icon-large"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 d-flex">
                        <div class="custom-block flex-fill d-flex flex-column justify-content-between p-4 rounded shadow-sm"
                            style="min-height: 260px;">
                            <div>
                                <h5 class="mb-2">{{ __('messages.speaking') }}</h5>
                                <p class="mb-3 small text-muted">{{ __('messages.speaking_desc') }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-design rounded-pill">Skill</span>
                                <i class="bi bi-mic icon-large"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="timeline-section section-padding" id="section_3">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="text-white">{{ __('messages.how_it_works') }}</h2>
                    </div>
                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>
                                <li>
                                    <h4 class="text-white mb-3">{{ __('messages.step_choose_exam') }}</h4>
                                    <p class="text-white">{{ __('messages.step_choose_exam_desc') }}</p>
                                    <div class="icon-holder">
                                        <i class="bi-search"></i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">{{ __('messages.step_take_test') }}</h4>
                                    <p class="text-white">{{ __('messages.step_take_test_desc') }}</p>
                                    <div class="icon-holder">
                                        <i class="bi-bookmark"></i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">{{ __('messages.step_get_score') }}</h4>
                                    <p class="text-white">{{ __('messages.step_get_score_desc') }}</p>
                                    <div class="icon-holder">
                                        <i class="bi-book"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-5">
                        <p class="text-white">
                            {{ __('messages.learn_more') }}
                            <a href="#"
                                class="btn custom-btn2 custom-border-btn ms-3">{{ __('messages.see_guide') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <section class="faq-section section-padding" id="section_4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h2 class="mb-4">{{ __('messages.faqs') }}</h2>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-5 col-12">
                        <img src="/src/images/faq_graphic.jpg" class="img-fluid" alt="FAQs">
                    </div>
                    <div class="col-lg-6 col-12 m-auto">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        {{ __('messages.faq_q1') }}
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ __('messages.faq_a1') }}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        {{ __('messages.faq_q2') }}
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ __('messages.faq_a2') }}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        {{ __('messages.faq_q3') }}
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ __('messages.faq_a3') }}
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        {{ __('messages.faq_q4') }}
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ __('messages.faq_a4') }}
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix">
                                        {{ __('messages.faq_q6') }}
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ __('messages.faq_a6') }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="contact-section section-padding section-bg" id="section_5" style="height:100vh;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12 text-center">
                        <h2>{{ __('messages.we_value_feedback') }}</h2>
                        <p>{{ __('messages.contact_prompt') }}</p>
                    </div>
                    <div class="col-lg-6 col-md-8 col-12">
                        <form action="" method="POST" class="custom-form contact-form" role="form">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="{{ __('messages.your_name_optional') }}">
                                <label for="name">{{ __('messages.your_name_optional') }}</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="{{ __('messages.your_email_optional') }}">
                                <label for="email">{{ __('messages.your_email_optional') }}</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea name="message" id="message" class="form-control" placeholder="{{ __('messages.your_feedback') }}"
                                    style="height: 160px;" required></textarea>
                                <label for="message">{{ __('messages.your_feedback') }}</label>
                            </div>
                            <div class="col-lg-12 col-12 text-center">
                                <button type="submit"
                                    class="btn btn-primary">{{ __('messages.send_feedback') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.footer')

        <!-- JAVASCRIPT FILES -->
        <script src="{{ asset('src/js/jquery.min.js') }}"></script>
        <script src="{{ asset('src/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('src/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('src/js/click-scroll.js') }}"></script>
        <script src="{{ asset('src/js/custom.js') }}"></script>
</body>

</html>
