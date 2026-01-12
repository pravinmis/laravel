<aside class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">

        <ul class="nav flex-column">
  @can('dashboard')
            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                   href="{{ url('/dashboard') }}">
                    📊 Dashboard
                </a>
            </li>
@endcan

            {{-- Posts --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   href="#postMenu">
                    📝 Posts
                </a>

                <div class="collapse {{ request()->is('posts*') ? 'show' : '' }}"
                     id="postMenu">
                    <ul class="nav flex-column ms-3">
                        @can('post.view')
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                All Posts
                            </a>
                        </li>
                        @endcan
                        @can('post.create')
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Add Post
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>


            {{-- Categories --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   href="#categoryMenu">
                    🗂 Categories
                </a>

                <div class="collapse {{ request()->is('categories*') ? 'show' : '' }}"
                     id="categoryMenu">
                    <ul class="nav flex-column ms-3">
                @can('category.list')
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Category List
                            </a>
                        </li>
                        @endcan

                        @can('category.create')
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Create Category
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>

            {{-- Products --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   href="#productMenu">
                    📦 Products
                </a>

                <div class="collapse {{ request()->is('products*') ? 'show' : '' }}"
                     id="productMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Product List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Bulk Product
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


 {{--  Orders--}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}"
                   data-bs-toggle="collapse"
                   href="#productMenu">
                    📦 Orders
                </a>

                <div class="collapse {{ request()->is('products*') ? 'show' : '' }}"
                     id="productMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Order List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Add Order
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="">
                                Bulk Order
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>
