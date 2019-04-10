<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('public/adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="{{ url('admin') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li><a href="{{ route('transaksi.index') }}"><i class="fa fa-money"></i><span> Transaksi Penjualan</span></a></li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-money"></i>
            <span>Produk</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('produk.index') }}"><i class="fa fa-circle-o"></i> Daftar Produk</a></li>
                <li><a href="{{ route('stok.index') }}"><i class="fa fa-circle-o"></i> Stok Produk</a></li>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-money"></i><span> Laporan</span></a></li>
        <li><a href="#"><i class="fa fa-money"></i><span> Keluar</span></a></li>
    </ul>
</section>
<!-- /.sidebar -->