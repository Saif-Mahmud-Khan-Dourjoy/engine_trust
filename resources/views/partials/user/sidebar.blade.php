<div class="sidebar">
    <div class="logo">
        <img class="logoImg" src="{{ asset('image/image_logo.svg') }}" alt="" />
    </div>
    <hr />
    <div class="menu">
        <ul>
            <div class="side-bar-item-div {{ url()->current() == route('user.home') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item  {{ url()->current() == route('user.home') ? 'active' : '' }}">
                    <a href="{{ route('user.home') }}"><img class="icon_img" src="{{ asset('image/statistics.svg') }}"
                            alt="" /><span>My Statistics</span></a>
                </li>
            </div>
            <div class="side-bar-item-div {{ Request::is('user/enquiry*') ? 'remove-border-bottom' : '' }}">
                <li
                    class="side-bar-item dropdown-sub-menu enquiry-sub-menu {{ Request::is('user/enquiry*') ? 'active' : '' }}">
                    <a href="{{ route('user.enquiry.engine') }}"><img class="icon_img" src="{{ asset('image/enquiry.svg') }}"
                            alt="" /><span>Enquiry</span></a>
                </li>
                <div>
                    <ul class="enquiry-sub dropdown-sub-items">

                        <li
                            class="dropdown-sub-item {{ url()->current() == route('user.enquiry.engine') ? 'hidden-active-sub-item' : '' }}">
                            <a href="{{ route('user.enquiry.engine') }}"><img class="icon_img"
                                    src="{{ asset('image/line.svg') }}" alt="" /><span>Engines</span></a>
                        </li>

                        <li
                            class="dropdown-sub-item {{ url()->current() == route('user.enquiry.gearbox') ? 'hidden-active-sub-item' : '' }}">
                            <a href="{{ route('user.enquiry.gearbox') }}"><img class="icon_img"
                                    src="{{ asset('image/line.svg') }}" alt="" /><span>Gearboxes</span></a>
                        </li>

                        <li
                            class="dropdown-sub-item {{ url()->current() == route('user.enquiry.anchillary') ? 'hidden-active-sub-item' : '' }}">
                            <a href="{{ route('user.enquiry.anchillary') }}"><img class="icon_img"
                                    src="{{ asset('image/line.svg') }}" alt="" /><span>Ancillaries</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div
                class="side-bar-item-div {{ url()->current() == route('user.quotes') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item {{ url()->current() == route('user.quotes') ? 'active' : '' }}">
                    <a href="{{ route('user.quotes') }}"><img class="icon_img" src="{{ asset('image/quotes.svg') }}"
                            alt="" /><span>My Quotes</span></a>
                </li>
            </div>
            <div class="side-bar-item-div {{ url()->current() == route('user.job') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item {{ url()->current() == route('user.job') ? 'active' : '' }}">
                    <a href="{{ route('user.job') }}"><img class="icon_img" src="{{ asset('image/job.svg') }}"
                            alt="" /><span>My Jobs</span></a>
                </li>
            </div>
            <div
                class="side-bar-item-div {{ url()->current() == route('user.employee') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item {{ url()->current() == route('user.employee') ? 'active' : '' }}">
                    <a href="{{ route('user.employee') }}"><img class="icon_img"
                            src="{{ asset('image/employee.svg') }}" alt="" /><span>Employee</span></a>
                </li>
            </div>
            <div class="side-bar-item-div {{ Request::is('user/hidden*') ? 'remove-border-bottom' : '' }}">
                <li
                    class="side-bar-item dropdown-sub-menu hidden-sub-menu {{ Request::is('user/hidden*') ? 'active' : '' }}">
                    <a href="{{ route('user.hidden.engine') }}"><img class="icon_img" src="{{ asset('image/hidden.svg') }}"
                            alt="" /><span>Hidden</span></a>
                </li>
                <div>
                    <ul class="hidden-sub dropdown-sub-items">
                        <li
                            class="hidden-dropdown-sub-item {{ url()->current() == route('user.hidden.engine') ? 'hidden-active-sub-item' : '' }}">
                            <a href="{{ route('user.hidden.engine') }}"><img class="icon_img"
                                    src="{{ asset('image/line.svg') }}" alt="" /><span>Engines</span></a>
                        </li>

                        <li
                            class="hidden-dropdown-sub-item {{ url()->current() == route('user.hidden.gearbox') ? 'hidden-active-sub-item' : '' }}">
                            <a href="{{ route('user.hidden.gearbox') }}"><img class="icon_img"
                                    src="{{ asset('image/line.svg') }}" alt="" /><span>Gearboxes</span></a>
                        </li>

                        <li
                            class="hidden-dropdown-sub-item {{ url()->current() == route('user.hidden.anchillary') ? 'hidden-active-sub-item' : '' }}">
                            <a href="{{ route('user.hidden.anchillary') }}"><img class="icon_img"
                                    src="{{ asset('image/line.svg') }}" alt="" /><span>Ancillaries</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </ul>
    </div>
    <div style="visibility: none; height: 30px"></div>
    {{-- <form action="{{ route('user.logout') }}" method="POST">
        @csrf
        <div class="logout_div" style="cursor: pointer">
            <img class="logout_img" src="{{ asset('image/logout.svg') }}" alt="" />
            <h4>Logout</h4>
        </div>
    </form> --}}

    <a style="text-decoration: none;color:inherit" class="" href="{{ route('user.logout') }}"
        onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
       <div class="logout_div" style="cursor: pointer">
        <img class="logout_img" src="{{ asset('image/logout.svg') }}" alt="" />
        <h4>Logout</h4>
    </div>
    </a>

    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</div>
