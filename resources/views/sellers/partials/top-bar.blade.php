<div class="topbar">
    <div class="logo">
        <!-- إضافة صورة داخل الإطار -->
        <div class="image-frame">
            <img src="path_to_image.jpg" alt="User Image" />
        </div>
    </div>
    <div class="nav-links">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </div>
    <div class="user-info">
        <span>Welcome, {{auth()->guard('seller')->user()->name}}</span>

        <form method="POST" action="{{ route('auth.seller.logout') }}">
        @csrf
        <button type="submit" class="nav-link btn btn-link text-danger">
            تسجيل الخروج
        </button>
    </form>
    </div>
</div>
