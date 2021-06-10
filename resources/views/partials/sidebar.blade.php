<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="{{request()->is('admin') ? 'active' : ''}}">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="{{request()->is('admin') ? 'active' : ''}}">
                <a href="{{route('product.index')}}">
                    <i class="fa fa-product-hunt"></i> <span>Product</span>
                </a>
            </li>
            <li class="{{request()->is('admin') ? 'active' : ''}}">
                <a href="{{route('customer.index')}}">
                    <i class="fa fa-users"></i> <span>Customer</span>
                </a>
            </li>
            <li class="{{request()->is('admin') ? 'active' : ''}}">
                <a href="{{route('order.index')}}">
                    <i class="fa fa-shopping-cart"></i> <span>Order</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
