
    <div class="user-info">
        <div class="user-img-container">
            <img src="./imges/mo1.jpg" alt="user">
            <span>Muhamed Reda</span>
        </div>
    </div>
    <div class="system-categories" id="menu-categories">
        <ul>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i>الصفحة الرئيسية</a></li>
            <li><a href="{{route("customers.index")}}"><i class="fas fa-sign-out-alt"></i>العملاء</a></li>
            <li><a href="{{route("exporters.index")}}"><i class="fas fa-sign-out-alt"></i>الموردين</a></li>
            <li class="hover"><a href="{{route("exports.create")}}"><i class="fas fa-sign-out-alt"></i>فاتورة مورد</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i>الاعدادات</a></li>
        </ul>
    </div>
</div>
