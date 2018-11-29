@php 
$datamenu = define_admin_menu()['data'];
@endphp

<aside class="left-sidebar">
    <!-- sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- user profile-->
                <li>
                    <!-- user profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20">
                        <div class="user-pic"><img src="/assets/images/users/1.jpg" alt="users" class="rounded-circle" width="40" /></div>
                        <div class="user-content hide-menu m-l-10">
                            <a href="javascript:void(0)" class="" id="userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="m-b-0 user-name font-medium">{{auth::user()->name}} <i class="fa fa-angle-down"></i></h5>
                                <span class="op-5 user-email">{{auth::user()->email}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userdd">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> my profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> account setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"  href="{{route('logout')}}"><i class="fa fa-power-off m-r-5 m-l-5"></i> logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- end user profile-->
                </li>
                <!-- user profile-->

                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">quản lý</span></li>

                @foreach($datamenu as $item_menu)

                @if(isset($item_menu['submenu']))

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi {{!empty($item_menu['icon']) ? $item_menu['icon'] : 'mdi-view-dashboard'}}"></i>
                        <span class="hide-menu" style="text-transform: uppercase;">{{!empty($item_menu['title']) ? $item_menu['title'] : ''}} </span>
                    </a>
                     <ul aria-expanded="false" class="collapse  first-level">
                    @foreach($item_menu['submenu'] as $itemsubmenu)
                    @php

                    if (!empty($itemsubmenu['route']) && url()->current() == route($itemsubmenu['route'])) {
                      $cls_active = '';
                  }else{
                      $cls_active = '';
                  }
                  @endphp

                  
                    <li class="sidebar-item">
                        <a href="{{!empty($itemsubmenu['route']) ? route($itemsubmenu['route']) : ''}}" class="sidebar-link {{$cls_active}}">
                            <i class="mdi {{!empty($itemsubmenu['icon']) ? $itemsubmenu['icon'] : 'mdi-note-outline'}}"></i>
                            <span class="hide-menu" >{{!empty($itemsubmenu['title']) ? $itemsubmenu['title'] : ''}} </span>
                        </a>
                    </li>

                @endforeach
                </ul>
            </li>
            @else


            @php
            if (!empty($item_menu['route']) && url()->current() == route($item_menu['route'])) {
              $cls_active = '';
          }else{
              $cls_active = '';
          }
          @endphp


          <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link {{$cls_active}}" href="{{!empty($item_menu['route']) ? route($item_menu['route']) : ''}}" aria-expanded="false"><i class="mdi  {{!empty($item_menu['icon']) ? $item_menu['icon'] : 'mdi-view-dashboard'}}"></i><span class="hide-menu" style="text-transform: uppercase;">{{!empty($item_menu['title']) ? $item_menu['title'] : ''}}</span></a></li>



          @endif
          @endforeach
      </ul>
  </nav>
  <!-- end sidebar navigation -->
</div>
<!-- end sidebar scroll-->
</aside>