        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image"> <img src="/cmadmin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a> 
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="{{ Active::checkRoute('admin.dashboard.*') }}"><a href="/admin/dashboard"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> <span class="pull-right-container"></span> </a></li>
                    @hasrole('Super Admin')
                    <li class="treeview {{-- {{ Active::checkRoute('admin.dashboard.*') }} --}} ">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>User Dashboards</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="{{ Active::checkRoute(['admin.dashboard.super-admin']) }}"><a href="/admin/dashboard"> <i class="fa fa-circle-o"></i> <span>SuperAdmin Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.admin']) }}"><a href="/admin/dashboard/admin"> <i class="fa fa-circle-o"></i> <span>Admin Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.product-manager']) }}"><a href="/admin/dashboard/product-manager"> <i class="fa fa-circle-o"></i> <span>Product Manager Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.order-manager']) }}"><a href="/admin/dashboard/order-manager"> <i class="fa fa-circle-o"></i> <span>Order Manager Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.logistics-manager']) }}"><a href="/admin/dashboard/logistics-manager"> <i class="fa fa-circle-o"></i> <span>Logistics Manager Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.accounts-manager']) }}"><a href="/admin/dashboard/accounts-manager"> <i class="fa fa-circle-o"></i> <span>Accounts Manager Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.business-manager']) }}"><a href="/admin/dashboard/business-manager"> <i class="fa fa-circle-o"></i> <span>Business Manager Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.media-manager']) }}"><a href="/admin/dashboard/media-manager"> <i class="fa fa-circle-o"></i> <span>Media Manager Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.editor']) }}"><a href="/admin/dashboard/editor"> <i class="fa fa-circle-o"></i> <span>Editor Dashboard</span></a></li>
                            <li class="{{ Active::checkRoute(['admin.dashboard.author']) }}"><a href="/admin/dashboard/author"> <i class="fa fa-circle-o"></i> <span>Author Dashboard</span></a></li>
                        </ul>
                    </li>
                    @endhasrole
                    <li class="header">CATALOGUE</li>
                    @can('List Product')<li class="{{ Active::checkRoute(['admin.product.index', 'admin.product.create', 'admin.product.edit', 'admin.product.show' ]) }}"><a href="/admin/product"> <i class="fa fa-circle-o"></i> <span>Product</span> <span class="pull-right-container"></span> </a></li>@endcan
                    <li class="treeview {{ Active::checkRoute(['admin.product.brand.*', 'admin.product.category.*', 'admin.product.custom.category.*', 'admin.product.attribute.*', 'admin.product.attribute.value*', 'admin.product.mfd-country.*', 'admin.product.design.*']) }} ">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>Product Settings</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            @can('List Product Category')<li class="{{ Active::checkRoute(['admin.product.category.*' ]) }}"><a href="/admin/product/category"> <i class="fa fa-circle-o"></i> <span>Product Category</span> <span class="pull-right-container"></span> </a></li>@endcan
                            @can('List Brand')<li class="{{ Active::checkRoute(['admin.product.brand.*' ]) }}"><a href="/admin/product/brand"> <i class="fa fa-circle-o"></i> <span>Product Brands</span> <span class="pull-right-container"></span> </a></li>@endcan
                            @can('List Custom Product Category')<li class="{{ Active::checkRoute(['admin.product.custom.category.*' ]) }}"><a href="/admin/product/custom/category"> <i class="fa fa-circle-o"></i> <span>Custom Product Category</span> <span class="pull-right-container"></span> </a></li>@endcan
                            @can('List Product Attribute')
                            <li class="treeview {{ Active::checkRoute(['admin.product.attribute.*']) }} ">
                                <a href="#"> <i class="fa fa-circle-o"></i> <span>Product Attributes</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    <li class="{{ Active::checkRoute(['admin.product.attribute.set.*' ]) }}"><a href="/admin/product/attribute/set"> <i class="fa fa-circle-o"></i> <span>Attribute Set</span> <span class="pull-right-container"></span> </a></li>
                                    <li class="{{ Active::checkRoute(['admin.product.attribute.index', 'admin.product.attribute.create', 'admin.product.attribute.edit' ]) }}"><a href="/admin/product/attribute"> <i class="fa fa-circle-o"></i> <span>Attributes</span> <span class="pull-right-container"></span> </a></li>
                                    <li class="{{ Active::checkRoute(['admin.product.attribute.value.index', 'admin.product.attribute.value.create', 'admin.product.attribute.value.edit' ]) }}"><a href="/admin/product/attribute/value"> <i class="fa fa-circle-o"></i> <span>Attribute Values</span> <span class="pull-right-container"></span> </a></li>
                                </ul>
                            </li>
                            @endcan
                            <li class="treeview {{ Active::checkRoute(['admin.product.design.*']) }} ">
                                <a href="#"> <i class="fa fa-circle-o"></i> <span>Product Designs</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    @can('List Product Shirt Design')<li class="{{ Active::checkRoute(['admin.product.design.shirt.*' ]) }}"><a href="/admin/product/design/shirt"> <i class="fa fa-circle-o"></i> <span>Shirt Design</span> <span class="pull-right-container"></span> </a></li>@endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="header">FABRIC MANAGEMENT</li>
                    {{-- @can('List Fabric')<li class=""><a href="/admin/fabric"> <i class="fa fa-circle-o"></i> <span>Fabric</span> <span class="pull-right-container"></span> </a></li>@endcan --}}
                    @can('List Fabric')<li class="{{ Active::checkRoute(['admin.product.fabric.index', 'admin.product.fabric.create', 'admin.product.fabric.edit' ]) }}"><a href="/admin/product/fabric"> <i class="fa fa-circle-o"></i> <span>Fabric</span> <span class="pull-right-container"></span> </a></li>@endcan
                    <li class="treeview {{ Active::checkRoute(['admin.product.fabric.class.*', 'admin.product.fabric.brand.*' ]) }}">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>Fabric Settings</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                             @can('List Fabric Class')<li class="{{ Active::checkRoute(['admin.product.fabric.class.*']) }}"><a href="/admin/product/fabric/class"> <i class="fa fa-circle-o"></i> <span>Fabric Class</span> <span class="pull-right-container"></span> </a></li>@endcan
                             @can('List Fabric Brand')<li class="{{ Active::checkRoute(['admin.product.fabric.brand.*']) }}"><a href="/admin/product/fabric/brand"> <i class="fa fa-circle-o"></i> <span>Fabric Brand</span> <span class="pull-right-container"></span> </a></li>@endcan
                        </ul>
                    </li>
                    {{-- @can('List Fabric Class')<li class="{{ Active::checkRoute(['admin.product.fabric.class.*']) }}"><a href="/admin/product/fabric/class"> <i class="fa fa-circle-o"></i> <span>Fabric Class</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Fabric Brand')<li class="{{ Active::checkRoute(['admin.product.fabric.brand.*']) }}"><a href="/admin/product/fabric/brand"> <i class="fa fa-circle-o"></i> <span>Fabric Brand</span> <span class="pull-right-container"></span> </a></li>@endcan --}}
                    <li class="header">STORE SETTINGS</li>
                    <li class="treeview {{ Active::checkRoute(['admin.product.tax.class.*', 'admin.product.tax.country.*', 'admin.product.tax.zone.*', 'admin.product.tax.rate.*']) }} ">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>Tax Settings</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            @can('List Tax Class')<li class="{{ Active::checkRoute(['admin.product.tax.class.*' ]) }}"><a href="/admin/product/tax/class"> <i class="fa fa-circle-o"></i> <span>Tax Class</span> <span class="pull-right-container"></span> </a></li>@endcan
                            @can('List Tax Rate')<li class="{{ Active::checkRoute(['admin.product.tax.rate.*' ]) }}"><a href="/admin/product/tax/rate"> <i class="fa fa-circle-o"></i> <span>Tax Rate</span> <span class="pull-right-container"></span> </a></li>@endcan
                        </ul>
                    </li>
                    <li class="treeview {{ Active::checkRoute(['admin.product.inventory.unit.*']) }} ">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>Inventory Settings</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            @can('List Inventory Unit')<li class="{{ Active::checkRoute(['admin.product.inventory.unit.*' ]) }}"><a href="/admin/product/inventory/unit"> <i class="fa fa-circle-o"></i> <span>Inventory Unit</span> <span class="pull-right-container"></span> </a></li>@endcan
                        </ul>
                    </li>
                    <li class="header">POST MANAGEMENT</li>
                    @can('List Guide')<li class=""><a href="/admin/guide"> <i class="fa fa-circle-o"></i> <span>Guide management</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Post')<li class=""><a href="/admin/post"> <i class="fa fa-circle-o"></i> <span>Post management</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Post Category')<li class=""><a href="/admin/post/category"> <i class="fa fa-circle-o"></i> <span>Category management</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Post Tag')<li class=""><a href="/admin/post/tag"> <i class="fa fa-circle-o"></i> <span>Tag management</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Post Status')<li class=""><a href="/admin/post/status"> <i class="fa fa-circle-o"></i> <span>Status management</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @hasrole('Super Admin')
                    <li class="header">ADMIN ROLES & PERMISSIONS</li>
                    <li class="{{ Active::checkRoute('admin.auth.users.*') }}"><a href="/admin/auth/users"><i class="fa fa-circle-o"></i> User Management</a></li>
                    <li class="{{ Active::checkRoute('admin.auth.roles.*') }}"><a href="/admin/auth/roles"><i class="fa fa-circle-o"></i> Role Management</a></li>
                    <li class="{{ Active::checkRoute('admin.auth.permissions.*') }}"><a href="/admin/auth/permissions"><i class="fa fa-circle-o"></i> Permission Management</a></li>
                    @endhasrole  
                </ul>
            </section>
        </aside>
        