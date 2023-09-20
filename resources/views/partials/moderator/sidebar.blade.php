<div class="sidebar">
    <div class="logo">
        <img class="logoImg" src="{{asset('image/image_logo.svg')}}" alt="" />
    </div>
    <hr />
    <div class="menu">
        <ul>
            <div class="side-bar-item-div {{url()->current() == route('moderator.home') ? 'remove-border-bottom' : ''}}">
                <li class="side-bar-item {{url()->current() == route('moderator.home') ? 'active' : ''}}" >
                    <a href="{{route('moderator.home')}}"><img class="icon_img" src="{{asset('image/dashboard.svg')}}"
                            alt="" /><span>Dashboard</span></a>
                </li>
            </div>
          
            <div class="side-bar-item-div {{url()->current() == route('moderator.approvedCompany') ? 'remove-border-bottom' : ''}}">
                <li class="side-bar-item {{url()->current() == route('moderator.approvedCompany') ? 'active' : ''}}" >
                    <a href="{{route('moderator.approvedCompany')}}"><img class="icon_img" src="{{asset('image/company1.svg')}}"
                            alt="" /><span>Companies</span></a>
                </li>
            </div>
            <div class="side-bar-item-div {{url()->current() == route('moderator.nonapprovedCompany') ? 'remove-border-bottom' : ''}}"">
                <li class="side-bar-item {{url()->current() == route('moderator.nonapprovedCompany') ? 'active' : ''}}">
                    <a href="{{route('moderator.nonapprovedCompany')}}"><img class="icon_img" src="{{asset('image/request.svg')}}" alt="" /><span>Requests</span></a>
                </li>
            </div>
        </ul>
    </div>
    <div style="visibility: none; height: 30px"></div>
     <div class="logout_div">
        <img class="logout_img" src="{{asset('image/logout.svg')}}" alt="" />
        <h4>Logout</h4>
    </div>

    <a style="text-decoration: none;color:inherit" class="" href="{{ route('moderator.logout') }}"
        onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
       <div class="logout_div" style="cursor: pointer">
        <img class="logout_img" src="{{ asset('image/logout.svg') }}" alt="" />
        <h4>Logout</h4>
    </div>
    </a>

    <form id="logout-form" action="{{ route('moderator.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
