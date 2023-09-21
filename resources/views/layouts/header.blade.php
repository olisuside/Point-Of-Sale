<header class=''>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @php
                    $produk = \App\Models\Produk::where('stok', 0)->get();
                    $jumlahHabis = count($produk);
                @endphp
                <ul class="navbar-nav ms-auto mb-lg-0">

                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#"
                            data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4' style="position: relative;"></i>
                            @if ($jumlahHabis > 0)
                          
                                <span class="badge badge-notification bg-danger" ">{{ $jumlahHabis }}</span>
                            @endif

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown" style="left: -5rem;"
                            aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">
                                <h6>Notifications</h6>
                            </li>


                            @foreach ($produk as $produk)
                                <li class="dropdown-item notification-item">
                                    <a class="d-flex align-items-center" href="#">
                                        <div class="notification-icon bg-danger">
                                            <i class="bi bi-exclamation-circle" ></i>
                                        </div>
                                        <div class="notification-text ms-4">
                                            <p class="notification-title font-bold">Stok Habis</p>
                                            <p class="notification-subtitle font-thin text-sm">Stok barang
                                                "{{ $produk->nama_produk }}" telah habis.</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">Administrator</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ url(auth()->user()->foto ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('profil') }}"><i
                                    class="icon-mid bi bi-person me-2"></i> My
                                Profile</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <a class="dropdown-item" href="#" onclick="$('#logout-form').submit()"><i
                                class="icon-mid bi bi-box-arrow-left me-2"></i>
                            Logout</a></li>
                        <li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
        @csrf
    </form>
    {{-- Logout --}}
</header>


{{-- 
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header> --}}
