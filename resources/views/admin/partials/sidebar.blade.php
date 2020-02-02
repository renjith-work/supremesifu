<aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image"> <img src="/cmadmin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> </div>
                    <div class="pull-left info">
                        {{-- <p>{{ Auth::user()->name }}</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>  --}}
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class=""><a href="/dashboard"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> <span class="pull-right-container"></span> </a></li>
                    <li class="header">POST MANAGEMENT</li>
                    <li class=""><a href="/admin/post"> <i class="fa fa-circle-o""></i> <span>Post management</span> <span class="pull-right-container"></span> </a></li>
                    <li class=""><a href="/admin/post/category"> <i class="fa fa-circle-o""></i> <span>Category management</span> <span class="pull-right-container"></span> </a></li>
                    <li class=""><a href="/admin/post/tag"> <i class="fa fa-circle-o""></i> <span>Tag management</span> <span class="pull-right-container"></span> </a></li>
                    <li class=""><a href="/admin/post/status"> <i class="fa fa-circle-o""></i> <span>Status management</span> <span class="pull-right-container"></span> </a></li>
                    {{-- <li class="{{ Active::check('dashboard') }}"><a href="/dashboard"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> <span class="pull-right-container"></span> </a></li> --}}
                    {{-- <li class="{{ Active::check('settings') }}"><a href="/settings"> <i class="fa fa-cogs"></i> <span>Global Settings</span> <span class="pull-right-container"></span> </a></li>
                    <li class="header">FABRIC MANAGEMENT</li>
                    <li class="{{ Active::checkRoute(['admin.fabric.index', 'admin.fabric.create', 'admin.fabric.edit']) }}"><a href="/admin/fabric"> <i class="fa fa-map"></i> <span>Fabrics </span> <span class="pull-right-container"></span> </a></li>
                    <li class="treeview {{ Active::checkRoute('admin.fabric.attribute.*') }} ">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>Fabric Settings</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="{{ Active::checkRoute(['admin.fabric.attribute.index', 'admin.fabric.attribute.create', 'admin.fabric.attribute.edit' ]) }}"><a href="/admin/fabric/attribute"> <i class="fa fa-circle-o"></i> <span>Fabric Attributes</span> <span class="pull-right-container"></span> </a></li>
                            <li class="{{ Active::checkRoute('admin.fabric.attribute.value.*') }}"><a href="/admin/fabric/attribute/value"> <i class="fa fa-circle-o"></i> <span>Fabric Attribute Values</span> <span class="pull-right-container"></span> </a></li>
                        </ul>
                    </li>
                    <li class="header">PRODUCT MANAGEMENT</li>
                    <li class="{{ Active::checkRoute(['admin.product.design.index', 'admin.product.design.create', 'admin.product.design.edit']) }}"><a href="/admin/product/design"> <i class="fa fa-paint-brush"></i> <span>Designs</span> <span class="pull-right-container"></span> </a></li>
                    <li class="treeview {{ Active::checkRoute(['admin.product.attribute.*', 'admin.product.category.*']) }} ">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>Product Settings</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="{{ Active::checkRoute(['admin.product.category.*']) }}"><a href="/admin/product/category"> <i class="fa fa-list-alt"></i> <span>Categories</span> <span class="pull-right-container"></span> </a></li>
                            <li class="{{ Active::checkRoute(['admin.product.attribute.index', 'admin.product.attribute.create', 'admin.product.attribute.edit' ]) }}"><a href="/admin/product/attribute"> <i class="fa fa-circle-o"></i> <span>Product Attributes</span> <span class="pull-right-container"></span> </a></li>
                            <li class="{{ Active::checkRoute('admin.product.attribute.value.*') }}"><a href="/admin/product/attribute/value"> <i class="fa fa-circle-o"></i> <span>Product Attribute Values</span> <span class="pull-right-container"></span> </a></li>
                        </ul>
                    </li>
                    <li class="header">STYLE MANAGEMENT</li>
                    <li class=""><a href="/style/shirt-style"> <i class="fa fa-dashboard"></i> <span>Shirt Style</span> <span class="pull-right-container"></span> </a></li>
                    <li class=""><a href="/design/monogram/position"> <i class="fa fa-dashboard"></i> <span>Monogram Positions</span> <span class="pull-right-container"></span> </a></li>
                    <li class="header">ORDER MANAGEMENT</li>
                    <li class="{{ Active::checkRoute(['admin.orders.index']) }}"><a href="/orders"> <i class="fa fa-paint-brush"></i> <span>Orders</span> <span class="pull-right-container"></span> </a></li>
                    
                    <li class="header">RESOURCE MANAGEMENT</li>
                    <li class="treeview {{ Active::checkRoute('admin.guide.*') }} ">
                        <a href="#"> <i class="fa fa-cogs"></i> <span>Guide Management</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="{{ Active::checkRoute(['admin.guide.index', 'admin.guide.create', 'admin.guide.edit' ]) }}"><a href="/admin/guide"> <i class="fa fa-circle-o"></i> <span>Guides</span> <span class="pull-right-container"></span> </a></li>
                            <li class="{{ Active::checkRoute(['admin.guide.category.index', 'admin.guide.category.create', 'admin.guide.category.edit' ]) }}"><a href="/admin/guide/category"> <i class="fa fa-circle-o"></i> <span>Guide Category</span> <span class="pull-right-container"></span> </a></li>
                        </ul>
                    </li>

                    <li class="header">BLOG MANAGEMENT</li>
                    @can('List Post')<li class="{{ Active::checkRoute(['post.index', 'post.create', 'post.edit', 'post.show']) }}"><a href="/post"> <i class="fa fa-circle-o"></i> <span>Blog Posts</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Post Category')<li class="{{ Active::checkRoute('post.category.*') }}"><a href="/post/category"> <i class="fa fa-circle-o"></i> <span>Post Category</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Post Tag')<li class="{{ Active::checkRoute('post.tag.*') }}"><a href="/post/tag"> <i class="fa fa-circle-o"></i> <span>Post Tags</span> <span class="pull-right-container"></span> </a></li>@endcan
                    @can('List Post Status')<li class="{{ Active::checkRoute('post.status.*') }}"><a href="/post/status"> <i class="fa fa-circle-o"></i> <span>Post Status</span> <span class="pull-right-container"></span> </a></li>@endcan
{{--                     
                    <li class="{{ Active::checkRoute(['post.index', 'post.create', 'post.edit', 'post.show']) }}"><a href="/post"> <i class="fa fa-circle-o"></i> <span>Blog Posts</span> <span class="pull-right-container"></span> </a></li>
                    <li class="{{ Active::checkRoute('post.category.*') }}"><a href="/post/category"> <i class="fa fa-circle-o"></i> <span>Post Category</span> <span class="pull-right-container"></span> </a></li>
                    <li class="{{ Active::checkRoute('post.tag.*') }}"><a href="/post/tag"> <i class="fa fa-circle-o"></i> <span>Post Tags</span> <span class="pull-right-container"></span> </a></li>
 --}}
{{--                     <li class="{{ Active::checkRoute('admin.post.status.*') }}"><a href="/admin/post/status"> <i class="fa fa-circle-o"></i> <span>Post Status</span> <span class="pull-right-container"></span> </a></li>


                    @hasrole('Super Admin')
                    <li class="header">SUPER ADMIN</li>
                    <li class="treeview {{ Active::check(['users', 'roles', 'permissions'],true) }}">
                        <a href="#"> <i class="fa fa-users"></i> <span>User & Roles</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="{{ Active::checkRoute('users.*') }}"><a href="/users"><i class="fa fa-circle-o"></i> User Management</a></li>
                            <li class="{{ Active::checkRoute('roles.*') }}"><a href="/roles"><i class="fa fa-circle-o"></i> Role Management</a></li>
                            <li class="{{ Active::checkRoute('permissions.*') }}"><a href="/permissions"><i class="fa fa-circle-o"></i> Permission Management</a></li>
                        </ul>
                    </li>
                    @endhasrole  
                    <li class="treeview"></li>  --}}
                </ul>
            </section>
        </aside>