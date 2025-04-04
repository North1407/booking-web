<div class="sidebar">
    <h2>TRIPMATE</h2>
    <a href="/home">Tổng quan</a>
    <a href="#" onclick="toggleSubmenu(event)">Quản lý tài khoản</a>
    <div class="submenu" style="display: none;">
        <a href="#">Tài khoản tài xế</a>
        <a href="#">Tài khoản khách hàng</a>
    </div>
    <a href="/rides">Quản lý chuyến xe</a>
    <a href="#">Quản lý đơn đặt vé</a>
    <a href="#">Quản lý xe</a>
    <a href="#">Quản lý khuyến mãi</a>
    <a href="#">Quản lý thanh toán</a>
    <a href="#">Quản lý khiếu nại</a>
    <a href="#">Báo cáo</a>
    <a href="#">Cài đặt</a>
</div>
<script>
    function toggleSubmenu(event) {
        event.preventDefault();
        const submenu = event.target.nextElementSibling;
        if (submenu && submenu.classList.contains('submenu')) {
            submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
        }
    }
</script>