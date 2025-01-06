<div class="sidebar">
    <ul>
        <li><a href="#">الصفحة الرئيسية</a></li>
        <li class="dropdown">
            <a href="#" onclick="toggleDropdown(this)">المنتجات</a>
            <ul class="dropdown-menu">
                <li><a href="#">المنتج 1</a></li>
                <li><a href="#">المنتج 2</a></li>
                <li><a href="#">المنتج 3</a></li>
            </ul>
        </li>


        <li class="dropdown">
            <a href="#" onclick="toggleDropdown(this)">الطلبات</a>
            <ul class="dropdown-menu">
                <li><a href="#">طلب 1</a></li>
                <li><a href="#">طلب 2</a></li>
                <li><a href="#">طلب 3</a></li>
            </ul>
        </li>


        <li class="dropdown">
            <a href="#" onclick="toggleDropdown(this)">العملاء</a>
            <ul class="dropdown-menu">
                <li><a href="#">طلب 1</a></li>
                <li><a href="#">طلب 2</a></li>
                <li><a href="#">طلب 3</a></li>
            </ul>
        </li>
        
        <li class="dropdown">
            <a href="#" onclick="toggleDropdown(this)">الاحصائيات</a>
            <ul class="dropdown-menu">
                <li><a href="#">طلب 1</a></li>
                <li><a href="#">طلب 2</a></li>
                <li><a href="#">طلب 3</a></li>
            </ul>
        </li>
         
        
        <li><a href="#">تسجيل خروج</a></li>
    </ul>
</div>



<script>

function toggleDropdown(element) {
    var allDropdownMenus = document.querySelectorAll('.dropdown-menu');
    
    allDropdownMenus.forEach(function(menu) {
        if (menu !== element.nextElementSibling) {
            menu.style.display = 'none';
        }
    });

    var dropdownMenu = element.nextElementSibling;

    if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
        dropdownMenu.style.display = 'block';
    } else {
        dropdownMenu.style.display = 'none';
    }
}



</script>

