<div class="sidebar">
    <div class="logo">
        <img class="logoImg" src="{{ asset('image/image_logo.svg') }}" alt="" />
    </div>
    <hr />
    <div class="menu">
        <ul>
            <div
                class="side-bar-item-div {{ url()->current() == route('superAdmin.home') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item {{ url()->current() == route('superAdmin.home') ? 'active' : '' }}">
                    <a href="{{ route('superAdmin.home') }}"><img class="icon_img"
                            src="{{ asset('image/dashboard.svg') }}" alt="" /><span>Dashboard</span></a>
                </li>
            </div>

            <div
                class="side-bar-item-div {{ url()->current() == route('superAdmin.company') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item {{ url()->current() == route('superAdmin.company') ? 'active' : '' }}">
                    <a href="{{ route('superAdmin.company') }}"><img class="icon_img"
                            src="{{ asset('image/company1.svg') }}" alt="" /><span>Companies</span></a>
                </li>
            </div>
            <div
                class="side-bar-item-div {{ url()->current() == route('superAdmin.enquiry') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item {{ url()->current() == route('superAdmin.enquiry') ? 'active' : '' }}">
                    <a href="{{ route('superAdmin.enquiry') }}"><img class="icon_img"
                            src="{{ asset('image/enquiry.svg') }}" alt="" /><span>Enquiry</span></a>
                </li>
            </div>
            <div
                class="side-bar-item-div {{ url()->current() == route('superAdmin.moderator') ? 'remove-border-bottom' : '' }}">
                <li class="side-bar-item {{ url()->current() == route('superAdmin.moderator') ? 'active' : '' }}">
                    <a href="{{ route('superAdmin.moderator') }}"><img class="icon_img"
                            src="{{ asset('image/administrator.svg') }}" alt="" /><span>Moderators</span></a>
                </li>
            </div>
        </ul>
    </div>
    <div style="visibility: none; height: 30px"></div>
    {{-- <div class="logout_div">
        <img class="logout_img" src="{{asset('image/logout.svg')}}" alt="" />
        <h4>Logout</h4>
    </div> --}}
    <a style="text-decoration: none;color:inherit" class="" href="{{ route('superAdmin.logout') }}"
        onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
        <div class="logout_div" style="cursor: pointer">
            <img class="logout_img" src="{{ asset('image/logout.svg') }}" alt="" />
            <h4>Logout</h4>
        </div>
    </a>

    <form id="logout-form" action="{{ route('superAdmin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
