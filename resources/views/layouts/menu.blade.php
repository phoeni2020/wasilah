@can('dashboard')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{!! url('dashboard') !!}">@if($icons)
                <i class="nav-icon fa fa-dashboard"></i>@endif
            <p>{{trans('lang.dashboard')}}</p></a>
    </li>
@endcan

<li class="nav-header">{{trans('lang.app_management')}}</li>

@can('drivers.index')

    <li class="nav-item has-treeview
    {{ Request::is('users*') ?
       'menu-open' : ''
    }}">

        <a href="#" class="nav-link
         {{ Request::is('orders*') ||
              Request::is('orderStatuses*') ||
              Request::is('deliveryAddresses*')?
              'active' : '' }}">
            @if($icons)
                <i class="nav-icon fa fa-id-card"></i>@endif
            <p>{{trans('lang.user_table')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('clint*') ? 'active' : '' }}" href="{!! url('clint') !!}">@if($icons)<i class="nav-icon fa fa-id-card"></i>@endif<p>{{__('lang.users')}}</p></a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('drivers*') ? 'active' : '' }}" href="{!! route('drivers.index') !!}">@if($icons)<i class="nav-icon fa fa-id-card"></i>@endif<p>{{trans('lang.driver_plural')}} </p></a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('allbaned*') ? 'active' : '' }}" href="{!! url('allbaned/users/') !!}">@if($icons)<i class="nav-icon fa fa-id-card"></i>@endif<p>AllBaned Users</p></a>
            </li>
        </ul>
    </li>
@endcan

<li class="nav-item">
        <a class="nav-link {{ Request::is('car*') ? 'active' : '' }}" href="{!! url('/car') !!}">@if($icons)
                <i class="nav-icon fa fa-car"></i>@endif<p>{{ trans('lang.car') }}</p></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                {{--tripe is using order routes--}}
                <a class="nav-link {{ Request::is('car*') ? 'active' : '' }}" href="{!! url('/car') !!}">@if($icons)
                        <i class="nav-icon fa fa-car"></i>@endif<p>{{ trans('lang.car') }}</p></a>
            </li>
            <li class="nav-item">
                    {{--tripe is using order routes--}}
                    <a class="nav-link {{ Request::is('car*') ? 'active' : '' }}" href="{!! url('/car/create') !!}">@if($icons)
                            <i class="nav-icon fa fa-car"></i>@endif<p>{{ trans('lang.car_create') }}</p></a>
            </li>

        </ul>
    </li>

@can('orders.index')
    <li class="nav-item has-treeview {{ Request::is('orders*') || Request::is('orderStatuses*') || Request::is('deliveryAddresses*')? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('orders*') || Request::is('orderStatuses*') || Request::is('deliveryAddresses*')? 'active' : '' }}"> @if($icons)
                <i class="nav-icon fa fa-car"></i>@endif
            <p>{{trans('lang.Trips')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('orders.index')
                <li class="nav-item">
                    {{--tripe is using order routes--}}
                    <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{!! route('orders.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-car"></i>@endif<p>{{ trans('lang.Inbound_trips') }}</p></a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ Request::is('outbound') ? 'active' : '' }}" href="{!! url('outbound') !!}">@if($icons)
                            <i class="nav-icon fa fa-car"></i>@endif<p>{{ trans('lang.Out_Bound') }}</p></a>
                </li>
            @endcan
        </ul>
    </li>

    <li class="nav-item has-treeview {{ Request::is('freight*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('freight*') ? 'active' : '' }}"> @if($icons)
                <i class="nav-icon fa fa-truck"></i>@endif
            <p>{{trans('lang.freight')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('orders.index')
                <li class="nav-item">
                    {{--tripe is using order routes--}}
                    <a class="nav-link {{ Request::is('freight*') ? 'active' : '' }}" href="{!! url('/freight/order/pending') !!}">@if($icons)
                            <i class="nav-icon fa fa fa-spinner "></i>@endif<p>{{ trans('lang.freight_order_pending') }}</p></a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ Request::is('outbound') ? 'active' : '' }}" href="{!! url('/freight/order/placed') !!}">@if($icons)
                            <i class="nav-icon fa fa-shopping-bag"></i>@endif<p>{{ trans('lang.freight_order_placed') }}</p></a>
                </li>
                <li class="nav-item">
                    {{--tripe is using order routes--}}
                    <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{!! url('/freight/order/packed')  !!}">@if($icons)
                            <i class="nav-icon fa fa-check-square-o"></i>@endif<p>{{ trans('lang.freight_order_packed') }}</p></a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ Request::is('outbound') ? 'active' : '' }}" href="{!! url('/freight/order/shipped')!!}">@if($icons)
                            <i class="nav-icon fa fa-truck"></i>@endif<p>{{ trans('lang.freight_order_shipped') }}</p></a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ Request::is('outbound') ? 'active' : '' }}" href="{!! url('/freight/order/delivered') !!}">@if($icons)
                            <i class="nav-icon fa fa-thumbs-up"></i>@endif<p>{{ trans('lang.freight_order_delivered') }}</p></a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('payments.index')
    <li class="nav-item has-treeview {{ Request::is('earnings*') || Request::is('driversPayouts*') || Request::is('marketsPayouts*') || Request::is('payments*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('earnings*') || Request::is('driversPayouts*') || Request::is('marketsPayouts*') || Request::is('payments*') ? 'active' : '' }}"> @if($icons)
                <i class="nav-icon fa fa-credit-card"></i>@endif
            <p>{{trans('lang.payment_plural')}}<i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">

            @can('payments.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('payments*') ? 'active' : '' }}" href="{!! route('payments.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-money"></i>@endif<p>{{trans('lang.payment_plural')}}</p></a>
                </li>
            @endcan

            @can('earnings.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('earnings*') ? 'active' : '' }}" href="{!! route('earnings.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-money"></i>
                        @endif
                        <p>{{trans('lang.earning_plural')}}</p></a>

                </li>
            @endcan

            @can('driversPayouts.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('driversPayouts*') ? 'active' : '' }}" href="{!! route('driversPayouts.index') !!}">@if($icons)<i class="nav-icon fa fa-dollar"></i>@endif<p>{{trans('lang.drivers_payout_plural')}}</p></a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('coupons.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('coupons*') ? 'active' : '' }}" href="{!! route('coupons.index') !!}">@if($icons)<i class="nav-icon fa fa-ticket"></i>@endif<p>{{trans('lang.coupon_plural')}} <span class="right badge badge-danger">New</span></p></a>
    </li>
@endcan

<li class="nav-header">{{trans('lang.app_setting')}}</li>

@can('app-settings')
    <li class="nav-item has-treeview {{ Request::is('settings/mobile*') || Request::is('slides*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('settings/mobile*') || Request::is('slides*') ? 'active' : '' }}">
            @if($icons)<i class="nav-icon fa fa-mobile"></i>@endif
            <p>
                {{trans('lang.mobile_menu')}}
                <i class="right fa fa-angle-left"></i>
            </p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{!! url('settings/mobile/globals') !!}" class="nav-link {{  Request::is('settings/mobile/globals*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-cog"></i> @endif <p>{{trans('lang.app_setting_globals')}} <span class="right badge badge-danger">New</span> </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/mobile/colors') !!}" class="nav-link {{  Request::is('settings/mobile/colors*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-pencil"></i> @endif <p>{{trans('lang.mobile_colors')}} <span class="right badge badge-danger">New</span> </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/mobile/home') !!}" class="nav-link {{  Request::is('settings/mobile/home*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-home"></i> @endif <p>{{trans('lang.mobile_home')}}
                        <span class="right badge badge-danger">New</span></p>
                </a>
            </li>

            @can('slides.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('slides*') ? 'active' : '' }}" href="{!! route('slides.index') !!}">@if($icons)<i class="nav-icon fa fa-magic"></i>@endif<p>{{trans('lang.slide_plural')}} <span class="right badge badge-danger">New</span></p></a>
                </li>
            @endcan
        </ul>

    </li>
    <li class="nav-item has-treeview {{
    (Request::is('settings*') ||
     Request::is('users*')) && !Request::is('settings/mobile*')
        ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{
        (Request::is('settings*') ||
         Request::is('users*')) && !Request::is('settings/mobile*')
          ? 'active' : '' }}"> @if($icons)<i class="nav-icon fa fa-cogs"></i>@endif
            <p>{{trans('lang.app_setting')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{!! url('settings/app/globals') !!}" class="nav-link {{  Request::is('settings/app/globals*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-cog"></i> @endif <p>{{trans('lang.app_setting_globals')}}</p>
                </a>
            </li>

            @can('users.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{!! route('users.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-users"></i>@endif
                        <p>{{trans('lang.user_plural')}}</p></a>
                </li>
            @endcan

            <li class="nav-item has-treeview {{ Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-user-secret"></i>@endif
                    <p>
                        {{trans('lang.permission_menu')}}
                        <i class="right fa fa-angle-left"></i>
                    </p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/permissions') ? 'active' : '' }}" href="{!! route('permissions.index') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.permission_table')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/permissions/create') ? 'active' : '' }}" href="{!! route('permissions.create') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.permission_create')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/roles') ? 'active' : '' }}" href="{!! route('roles.index') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.role_table')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/roles/create') ? 'active' : '' }}" href="{!! route('roles.create') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.role_create')}}</p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('settings/customFields*') ? 'active' : '' }}" href="{!! route('customFields.index') !!}">@if($icons)
                        <i class="nav-icon fa fa-list"></i>@endif<p>{{trans('lang.custom_field_plural')}}</p></a>
            </li>


            <li class="nav-item">
                <a href="{!! url('settings/app/localisation') !!}" class="nav-link {{  Request::is('settings/app/localisation*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-language"></i> @endif <p>{{trans('lang.app_setting_localisation')}}</p></a>
            </li>
            <li class="nav-item">
                <a href="{!! url('settings/translation/en') !!}" class="nav-link {{ Request::is('settings/translation*') ? 'active' : '' }}">
                    @if($icons) <i class="nav-icon fa fa-language"></i> @endif <p>{{trans('lang.app_setting_translation')}}</p></a>
            </li>
            @can('currencies.index')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('settings/currencies*') ? 'active' : '' }}" href="{!! route('currencies.index') !!}">@if($icons)<i class="nav-icon fa fa-dollar"></i>@endif<p>{{trans('lang.currency_plural')}}</p></a>
            </li>
            @endcan

            <li class="nav-item">
                <a href="{!! url('settings/payment/payment') !!}" class="nav-link {{  Request::is('settings/payment*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-credit-card"></i> @endif <p>{{trans('lang.app_setting_payment')}}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/app/social') !!}" class="nav-link {{  Request::is('settings/app/social*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-globe"></i> @endif <p>{{trans('lang.app_setting_social')}}</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{!! url('settings/app/notifications') !!}" class="nav-link {{  Request::is('settings/app/notifications*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-bell"></i> @endif <p>{{trans('lang.app_setting_notifications')}}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/mail/smtp') !!}" class="nav-link {{ Request::is('settings/mail*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-envelope"></i> @endif <p>{{trans('lang.app_setting_mail')}}</p>
                </a>
            </li>

        </ul>
    </li>
@endcan