
<script>
  
// Toggle Sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    sidebar.classList.toggle('collapsed');

    // Save state to localStorage
    if (sidebar.classList.contains('collapsed')) {
        localStorage.setItem('adminSidebarCollapsed', 'true');
    } else {
        localStorage.setItem('adminSidebarCollapsed', 'false');
    }
}

// Restore sidebar state from localStorage
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('adminSidebar');
    const isCollapsed = localStorage.getItem('adminSidebarCollapsed');

    if (isCollapsed === 'true') {
        sidebar.classList.add('collapsed');
    }

    // Active menu highlighting
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (currentPath.includes(href.replace('<?= BASE_URL ?>', ''))) {
            link.classList.add('active');
        }
    });
});

// Mobile sidebar toggle
function toggleMobileSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    sidebar.classList.toggle('mobile-show');
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('adminSidebar');
    const isClickInside = sidebar.contains(e.target);

    if (!isClickInside && window.innerWidth <= 768 && sidebar.classList.contains('mobile-show')) {
        sidebar.classList.remove('mobile-show');
    }
});
</script>

</main>
</div>
</body>
</html>
