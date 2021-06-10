<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active"  href="{{ url('/' . ($page = '')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>

        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = '')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>

    </div>
    <div class="main-sidemenu">
            <br>


    @if(auth('admin')->check())
        <ul class="side-menu">

            <li class="side-item side-item-category">القوائم الرئيسية</li>

            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                        <path
                            d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                    </svg><span class="side-menu__label">الاحصائيات</span></a>
            </li>
            @if (str_contains(auth('admin')->user()->permissions, "show_admin") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/admins')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M21.881,5.223c-0.015-0.378-0.421-0.603-0.747-0.412c-0.672,0.392-1.718,0.898-2.643,0.898 c-0.421,0-0.849-0.064-1.289-0.198c-0.265-0.08-0.532-0.178-0.808-0.309c-1.338-0.639-2.567-1.767-3.696-2.889 C12.506,2.122,12.253,2.027,12,2.023c-0.253,0.004-0.506,0.099-0.698,0.29c-1.129,1.122-2.358,2.25-3.696,2.889c0,0,0,0-0.001,0 C7.33,5.333,7.063,5.431,6.798,5.511c-0.44,0.134-0.869,0.198-1.289,0.198c-0.925,0-1.971-0.507-2.643-0.898 C2.54,4.62,2.134,4.845,2.119,5.223c-0.061,1.538-0.077,4.84,0.688,7.444c1.399,4.763,4.48,7.976,8.91,9.292L11.857,22l0.14-0.014 V22v-0.014H12L12.143,22l0.14-0.041c4.43-1.316,7.511-4.529,8.91-9.292C21.958,10.063,21.941,6.761,21.881,5.223z"/>
                    </svg><span class="side-menu__label">المدراء</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_user") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/users')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M21,2H6C4.896,2,4,2.896,4,4v3H2v2h2v2H2v2h2v2H2v2h2v3c0,1.104,0.896,2,2,2h15c0.553,0,1-0.447,1-1V3 C22,2.447,21.553,2,21,2z M13,4.999c1.648,0,3,1.351,3,3C16,9.647,14.648,11,13,11c-1.647,0-3-1.353-3-3.001 C10,6.35,11.353,4.999,13,4.999z M19,18H7v-0.75c0-2.219,2.705-4.5,6-4.5s6,2.281,6,4.5V18z"/>
                    </svg><span class="side-menu__label">المستخدمين</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_trader") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/traders')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M21,7h-6c-0.553,0-1,0.447-1,1v3h-2V4c0-0.553-0.447-1-1-1H3C2.447,3,2,3.447,2,4v16c0,0.553,0.447,1,1,1h7h1h4h1h5 c0.553,0,1-0.447,1-1V8C22,7.447,21.553,7,21,7z M8,6h2v2H8V6z M6,16H4v-2h2V16z M6,12H4v-2h2V12z M6,8H4V6h2V8z M10,16H8v-2h2V16z M10,12H8v-2h2v1V12z M19,16h-2v-2h2V16z M19,12h-2v-2h2V12z"/>
                    </svg><span class="side-menu__label">التجار</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_employee") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/employees')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M16.604,11.048c0.604-1.029,0.872-2.228,0.751-3.44c-0.179-1.784-1.175-3.361-2.803-4.44l-1.105,1.666 c1.119,0.742,1.8,1.799,1.918,2.974c0.11,1.105-0.28,2.194-1.072,2.986l-1.192,1.192l1.618,0.475C18.951,13.701,19,17.957,19,18h2 C21,16.211,20.044,12.715,16.604,11.048z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M9.5 12c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4S7.294 12 9.5 12zM9.5 6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2S8.397 6 9.5 6zM11 13H8c-3.309 0-6 2.691-6 6v1h2v-1c0-2.206 1.794-4 4-4h3c2.206 0 4 1.794 4 4v1h2v-1C17 15.691 14.309 13 11 13z"/>
                    </svg><span class="side-menu__label">الموظفين</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_bidding") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/biddings')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M2 3H4V21H2zM20 3H22V21H20zM5 13L7 13 7 14 9 14 9 13 11 13 11 14 13 14 13 13 17 13 17 14 19 14 19 13 19 11 19 10 17 10 17 11 13 11 13 10 11 10 11 11 9 11 9 10 7 10 7 11 5 11zM5 4L5 5 5 7 5 8 7 8 7 7 15 7 15 8 17 8 17 7 19 7 19 5 17 5 17 4 15 4 15 5 7 5 7 4zM5 17L5 19 5 20 7 20 7 19 9 19 9 20 11 20 11 19 19 19 19 17 11 17 11 16 9 16 9 17 7 17 7 16 5 16z"/>
                    </svg><span class="side-menu__label">المزادات</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_order") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/orders')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M20.772,10.156l-1.368-4.105C18.995,4.824,17.852,4,16.559,4H7.441C6.148,4,5.005,4.824,4.596,6.051l-1.368,4.105 C2.508,10.459,2,11.171,2,12v5c0,0.753,0.423,1.402,1.039,1.743C3.026,18.809,3,18.869,3,18.938V21c0,0.553,0.447,1,1,1h1 c0.553,0,1-0.447,1-1v-2h12v2c0,0.553,0.447,1,1,1h1c0.553,0,1-0.447,1-1v-2.062c0-0.069-0.026-0.13-0.039-0.195 C21.577,18.402,22,17.753,22,17v-5C22,11.171,21.492,10.459,20.772,10.156z M4,17v-5h16l0.002,5H4z M7.441,6h9.117 c0.431,0,0.813,0.274,0.949,0.684L18.613,10H5.387l1.105-3.316C6.629,6.274,7.011,6,7.441,6z"/>
                        <circle xmlns="http://www.w3.org/2000/svg" cx="6.5" cy="14.5" r="1.5"/>
                        <circle xmlns="http://www.w3.org/2000/svg" cx="17.5" cy="14.5" r="1.5"/>
                    </svg><span class="side-menu__label">السيارات المباعة</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_bidder") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/bidders')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M19,12c0-3.866-3.135-7-7-7v14C15.865,19,19,15.866,19,12z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M12,22c5.514,0,10-4.486,10-10S17.514,2,12,2S2,6.486,2,12S6.486,22,12,22z M12,4c4.411,0,8,3.589,8,8s-3.589,8-8,8 s-8-3.589-8-8S7.589,4,12,4z"/>
                    </svg><span class="side-menu__label">المزايدات</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_insurance") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/insurances')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M15 11H22V13H15zM16 15H22V17H16zM14 7H22V9H14zM4 19h8 1 1v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h1H4zM8 12c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"/>
                    </svg><span class="side-menu__label"> طلبات دفع التأمين </span>
                    @if(\App\Models\insurances::where('status','=','waiting')->count() > 0)
                        <button style="font-size: 15px" class="btn btn-sm btn-danger">
                            {{ \App\Models\insurances::where('status','=','waiting')->count() }}
                        </button>
                    @endif
                </a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_insurance_slide") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/insurances_slides')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" fill="none" d="M12,4c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S16.411,4,12,4z M13,16.915V18h-2v-1.08 C8.661,16.553,8,14.918,8,14h2c0.011,0.143,0.159,1,2,1c1.38,0,2-0.585,2-1c0-0.324,0-1-2-1c-3.48,0-4-1.88-4-3 c0-1.288,1.029-2.584,3-2.915V6.012h2v1.109c1.734,0.41,2.4,1.853,2.4,2.879h-1l-1,0.018C13.386,9.638,13.185,9,12,9 c-1.299,0-2,0.516-2,1c0,0.374,0,1,2,1c3.48,0,4,1.88,4,3C16,15.288,14.971,16.584,13,16.915z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.514,2,12,2z M12,20c-4.411,0-8-3.589-8-8s3.589-8,8-8 s8,3.589,8,8S16.411,20,12,20z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M12,11c-2,0-2-0.626-2-1c0-0.484,0.701-1,2-1c1.185,0,1.386,0.638,1.4,1.018l1-0.018h1c0-1.026-0.666-2.469-2.4-2.879 V6.012h-2v1.073C9.029,7.416,8,8.712,8,10c0,1.12,0.52,3,4,3c2,0,2,0.676,2,1c0,0.415-0.62,1-2,1c-1.841,0-1.989-0.857-2-1H8 c0,0.918,0.661,2.553,3,2.92V18h2v-1.085c1.971-0.331,3-1.627,3-2.915C16,12.88,15.48,11,12,11z"/>
                    </svg><span class="side-menu__label"> شرائح التأمين </span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_brand") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/brands')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M12,22c5.421,0,10-4.579,10-10S17.421,2,12,2S2,6.579,2,12S6.579,22,12,22z M12,4c4.337,0,8,3.663,8,8s-3.663,8-8,8 s-8-3.663-8-8S7.663,4,12,4z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M12,17c0.901,0,2.581-0.168,3.707-1.292l-1.414-1.416C13.85,14.735,12.992,15,12,15c-1.626,0-3-1.374-3-3s1.374-3,3-3 c0.993,0,1.851,0.265,2.293,0.707l1.414-1.414C14.582,7.168,12.901,7,12,7c-2.757,0-5,2.243-5,5S9.243,17,12,17z"/>
                    </svg><span class="side-menu__label">العلامات التجارية</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_model") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/models')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M4,21h15.893c1.103,0,2-0.897,2-2V7V5v0l0,0c0-1.103-0.897-2-2-2H4C2.897,3,2,3.897,2,5v14C2,20.103,2.897,21,4,21z M4,19 v-5h4v5H4z M14,7v5h-4V7H14z M8,7v5H4V7H8z M10,19v-5h4v5H10z M16,19v-5h3.894v5H16z M19.893,12H16V7h3.893V12z"/>
                    </svg><span class="side-menu__label">الموديلات</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_model_year") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/model_years')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M7 11H9V13H7zM7 15H9V17H7zM11 11H13V13H11zM11 15H13V17H11zM15 11H17V13H15zM15 15H17V17H15z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M5,22h14c1.103,0,2-0.897,2-2V8V6c0-1.103-0.897-2-2-2h-2V2h-2v2H9V2H7v2H5C3.897,4,3,4.897,3,6v2v12 C3,21.103,3.897,22,5,22z M19,8l0.001,12H5V8H19z"/>
                    </svg><span class="side-menu__label">سنوات الموديلات</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_feature") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/features')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                        <path xmlns="http://www.w3.org/2000/svg" d="M20,7h-1.209C18.922,6.589,19,6.096,19,5.5C19,3.57,17.43,2,15.5,2c-1.622,0-2.705,1.482-3.404,3.085 C11.407,3.57,10.269,2,8.5,2C6.57,2,5,3.57,5,5.5C5,6.096,5.079,6.589,5.209,7H4C2.897,7,2,7.897,2,9v2c0,1.103,0.897,2,2,2v7 c0,1.103,0.897,2,2,2h5h2h5c1.103,0,2-0.897,2-2v-7c1.103,0,2-0.897,2-2V9C22,7.897,21.103,7,20,7z M15.5,4 C16.327,4,17,4.673,17,5.5C17,7,16.374,7,16,7h-2.478C14.033,5.424,14.775,4,15.5,4z M7,5.5C7,4.673,7.673,4,8.5,4 c0.888,0,1.714,1.525,2.198,3H8C7.626,7,7,7,7,5.5z M4,9h7v2H4V9z M6,20v-7h5v7H6z M18,20h-5v-7h5V20z M13,11V9.085 C13.005,9.057,13.011,9.028,13.017,9H20l0.001,2H13z"/>                    </svg>
                    <span class="side-menu__label">الميزات</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_country") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/countries')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M19,4H6V2H4v18H3v2h1h2h1v-2H6v-5h13c0.553,0,1-0.448,1-1V5C20,4.448,19.553,4,19,4z M18,13H6V6h12V13z"/>
                    </svg><span class="side-menu__label">البلاد</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_city") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/cities')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M19,2H9C7.897,2,7,2.897,7,4v6H5c-1.103,0-2,0.897-2,2v9c0,0.552,0.447,1,1,1h8h8c0.553,0,1-0.448,1-1V4 C21,2.897,20.103,2,19,2z M5,12h3h3v2v2v4H5V12z M19,20h-6v-4v-2v-2c0-1.103-0.897-2-2-2H9V4h10V20z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M11 6H13V8H11zM15 6H17V8H15zM15 10.031H17V12H15zM15 14H17V16H15zM7 14.001H9V16.000999999999998H7z"/>
                    </svg><span class="side-menu__label">المحافظات</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "show_region") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/regions')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M12 16L17 10 7 10z"/>
                        <path xmlns="http://www.w3.org/2000/svg" d="M19,3H5C3.897,3,3,3.897,3,5v14c0,1.103,0.897,2,2,2h14c1.103,0,2-0.897,2-2V5C21,3.897,20.103,3,19,3z M5,19V5h14 l0.002,14H5z"/>
                    </svg><span class="side-menu__label">الأحياء</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "setting") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/settings')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path xmlns="http://www.w3.org/2000/svg" d="M12,16c2.206,0,4-1.794,4-4s-1.794-4-4-4s-4,1.794-4,4S9.794,16,12,16z M12,10c1.084,0,2,0.916,2,2s-0.916,2-2,2 s-2-0.916-2-2S10.916,10,12,10z"/>                        <path xmlns="http://www.w3.org/2000/svg" d="M2.845,16.136l1,1.73c0.531,0.917,1.809,1.261,2.73,0.73l0.529-0.306C7.686,18.747,8.325,19.122,9,19.402V20 c0,1.103,0.897,2,2,2h2c1.103,0,2-0.897,2-2v-0.598c0.675-0.28,1.314-0.655,1.896-1.111l0.529,0.306 c0.923,0.53,2.198,0.188,2.731-0.731l0.999-1.729c0.552-0.955,0.224-2.181-0.731-2.732l-0.505-0.292C19.973,12.742,20,12.371,20,12 s-0.027-0.743-0.081-1.111l0.505-0.292c0.955-0.552,1.283-1.777,0.731-2.732l-0.999-1.729c-0.531-0.92-1.808-1.265-2.731-0.732 l-0.529,0.306C16.314,5.253,15.675,4.878,15,4.598V4c0-1.103-0.897-2-2-2h-2C9.897,2,9,2.897,9,4v0.598 c-0.675,0.28-1.314,0.655-1.896,1.111L6.575,5.403c-0.924-0.531-2.2-0.187-2.731,0.732L2.845,7.864 c-0.552,0.955-0.224,2.181,0.731,2.732l0.505,0.292C4.027,11.257,4,11.629,4,12s0.027,0.742,0.081,1.111l-0.505,0.292 C2.621,13.955,2.293,15.181,2.845,16.136z M6.171,13.378C6.058,12.925,6,12.461,6,12c0-0.462,0.058-0.926,0.17-1.378 c0.108-0.433-0.083-0.885-0.47-1.108L4.577,8.864l0.998-1.729L6.72,7.797c0.384,0.221,0.867,0.165,1.188-0.142 c0.683-0.647,1.507-1.131,2.384-1.399C10.713,6.128,11,5.739,11,5.3V4h2v1.3c0,0.439,0.287,0.828,0.708,0.956 c0.877,0.269,1.701,0.752,2.384,1.399c0.321,0.307,0.806,0.362,1.188,0.142l1.144-0.661l1,1.729L18.3,9.514 c-0.387,0.224-0.578,0.676-0.47,1.108C17.942,11.074,18,11.538,18,12c0,0.461-0.058,0.925-0.171,1.378 c-0.107,0.433,0.084,0.885,0.471,1.108l1.123,0.649l-0.998,1.729l-1.145-0.661c-0.383-0.221-0.867-0.166-1.188,0.142 c-0.683,0.647-1.507,1.131-2.384,1.399C13.287,17.872,13,18.261,13,18.7l0.002,1.3H11v-1.3c0-0.439-0.287-0.828-0.708-0.956 c-0.877-0.269-1.701-0.752-2.384-1.399c-0.19-0.182-0.438-0.275-0.688-0.275c-0.172,0-0.344,0.044-0.5,0.134l-1.144,0.662l-1-1.729 L5.7,14.486C6.087,14.263,6.278,13.811,6.171,13.378z"/>
                    </svg><span class="side-menu__label">الاعدادات</span></a>
            </li>
            @endif
            @if (str_contains(auth('admin')->user()->permissions, "contact") !== false)
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/contacts')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                        <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"></path></svg>
                    <span class="side-menu__label">الرسائل</span></a>
            </li>
            @endif
            <br><br>
        </ul>
        @elseif(auth('trader')->check())

            <ul class="side-menu">

                <li class="side-item side-item-category">القوائم الرئيسية</li>

                <li class="slide">
                    <a class="side-menu__item" href="{{ url('/' . ($page = 'trader')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                            <path
                                d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                        </svg><span class="side-menu__label">الاحصائيات</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{ url('/' . ($page = 'trader/c_employees')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                            <path xmlns="http://www.w3.org/2000/svg" d="M21,7h-6c-0.553,0-1,0.447-1,1v3h-2V4c0-0.553-0.447-1-1-1H3C2.447,3,2,3.447,2,4v16c0,0.553,0.447,1,1,1h7h1h4h1h5 c0.553,0,1-0.447,1-1V8C22,7.447,21.553,7,21,7z M8,6h2v2H8V6z M6,16H4v-2h2V16z M6,12H4v-2h2V12z M6,8H4V6h2V8z M10,16H8v-2h2V16z M10,12H8v-2h2v1V12z M19,16h-2v-2h2V16z M19,12h-2v-2h2V12z"/>
                        </svg><span class="side-menu__label">الموظفين</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" href="{{ url('/' . ($page = 'trader/c_biddings')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path xmlns="http://www.w3.org/2000/svg" d="M2 3H4V21H2zM20 3H22V21H20zM5 13L7 13 7 14 9 14 9 13 11 13 11 14 13 14 13 13 17 13 17 14 19 14 19 13 19 11 19 10 17 10 17 11 13 11 13 10 11 10 11 11 9 11 9 10 7 10 7 11 5 11zM5 4L5 5 5 7 5 8 7 8 7 7 15 7 15 8 17 8 17 7 19 7 19 5 17 5 17 4 15 4 15 5 7 5 7 4zM5 17L5 19 5 20 7 20 7 19 9 19 9 20 11 20 11 19 19 19 19 17 11 17 11 16 9 16 9 17 7 17 7 16 5 16z"/>
                        </svg><span class="side-menu__label">المزادات</span></a>
                </li>

            </ul>


        @elseif(auth('employee')->check())

            <ul class="side-menu">

                <li class="side-item side-item-category">القوائم الرئيسية</li>

                <li class="slide">
                    <a class="side-menu__item" href="{{ url('/' . ($page = 'employee/e_biddings')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path xmlns="http://www.w3.org/2000/svg" d="M2 3H4V21H2zM20 3H22V21H20zM5 13L7 13 7 14 9 14 9 13 11 13 11 14 13 14 13 13 17 13 17 14 19 14 19 13 19 11 19 10 17 10 17 11 13 11 13 10 11 10 11 11 9 11 9 10 7 10 7 11 5 11zM5 4L5 5 5 7 5 8 7 8 7 7 15 7 15 8 17 8 17 7 19 7 19 5 17 5 17 4 15 4 15 5 7 5 7 4zM5 17L5 19 5 20 7 20 7 19 9 19 9 20 11 20 11 19 19 19 19 17 11 17 11 16 9 16 9 17 7 17 7 16 5 16z"/>
                        </svg><span class="side-menu__label">المزادات</span></a>
                </li>
            </ul>

        @endif


    </div>
</aside>
<!-- main-sidebar -->
