<div class="topbar">
    <div class="username">Xin chào, Admin</div>

    <div class="logout">
        <a href="/logout">Đăng xuất</a>
    </div>
</div>
<div class="sidebar">
    <h2>TRIPMATE</h2>
    <a href="/home">Trang chủ</a>
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
<style>
    .topbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 50px;
        background-color: royalblue;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;

    }

    .topbar .username {
        font-size: 16px;
    }

    .topbar .logout a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }

    .sidebar {
        margin-top: 50px;
        width: 200px;
        height: calc(100vh - 50px);
        background-color: cornflowerblue;
        padding: 20px;
        /* Adjust for the fixed topbar */
        /* ...existing styles... */
    }
</style>