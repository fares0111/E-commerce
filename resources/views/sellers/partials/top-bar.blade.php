<div class="topbar">
    <div class="logo">
        <!-- إطار الصورة -->
        <div class="image-frame" onclick="toggleDropdown(this)">
            <img src="{{ Storage::url(auth()->guard('seller')->user()->profile_picture) }}" alt="User Image" />
        </div>
        <!-- القائمة المنسدلة -->
        <ul class="dropdown-menu">
            <h6 class='admin_mail'>{{auth()->guard('seller')->user()->email}}</h6>
            <li><a href="#"> الملف الشخصي</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"> </a></li>
        </ul>
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


<script>
    function toggleDropdown(element) {
    // إخفاء جميع القوائم المفتوحة
    var allDropdownMenus = document.querySelectorAll('.dropdown-menu');
    allDropdownMenus.forEach(function(menu) {
        if (menu !== element.parentElement.querySelector('.dropdown-menu1')) {
            menu.style.display = 'none';
        }
    });

    // تبديل عرض القائمة المنسدلة الحالية
    var dropdownMenu = element.parentElement.querySelector('.dropdown-menu');
    if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
        dropdownMenu.style.display = 'block';
    } else {
        dropdownMenu.style.display = 'none';
    }
}

// إغلاق القائمة عند النقر خارجها
document.addEventListener('click', function(event) {
    var dropdownMenus = document.querySelectorAll('.dropdown-menu');
    dropdownMenus.forEach(function(menu) {
        if (!menu.contains(event.target) && !menu.parentElement.contains(event.target)) {
            menu.style.display = 'none';
        }
    });
});

</script>