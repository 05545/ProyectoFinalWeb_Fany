    // Preloader
    window.addEventListener('load', function() {
      const preloader = document.getElementById('preloader');
      setTimeout(function() {
        preloader.style.opacity = '0';
        setTimeout(function() {
          preloader.style.display = 'none';
        }, 500);
      }, 800);
    });

    // Toggle Sidebar
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const body = document.body;
    
    toggleSidebar.addEventListener('click', function(e) {
      e.preventDefault();
      body.classList.toggle('sidebar-collapse');
      
      // For mobile
      if (window.innerWidth < 992) {
        sidebar.classList.toggle('show');
      }
    });

    // Search Toggle
    const searchBtn = document.getElementById('search-btn');
    const searchCloseBtn = document.getElementById('search-close-btn');
    const searchBlock = document.querySelector('.navbar-search-block');
    
    searchBtn.addEventListener('click', function(e) {
      e.preventDefault();
      searchBlock.classList.add('show');
      setTimeout(() => {
        searchBlock.querySelector('input').focus();
      }, 100);
    });
    
    searchCloseBtn.addEventListener('click', function(e) {
      e.preventDefault();
      searchBlock.classList.remove('show');
    });

    // Fullscreen Toggle
    const fullscreenBtn = document.getElementById('fullscreen-btn');
    
    fullscreenBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        }
      }
    });

    // Control Sidebar Toggle
    const controlSidebarBtn = document.getElementById('control-sidebar-btn');
    const controlSidebar = document.getElementById('control-sidebar');
    
    controlSidebarBtn.addEventListener('click', function(e) {
      e.preventDefault();
      controlSidebar.classList.toggle('show');
    });

    // Close control sidebar when clicking outside
    document.addEventListener('click', function(e) {
      if (!controlSidebar.contains(e.target) && !controlSidebarBtn.contains(e.target) && controlSidebar.classList.contains('show')) {
        controlSidebar.classList.remove('show');
      }
    });

    // Responsive behavior
    window.addEventListener('resize', function() {
      if (window.innerWidth < 992) {
        body.classList.remove('sidebar-collapse');
        sidebar.classList.remove('show');
      }
    });

    // Glow intensity control
    const glowRange = document.getElementById('glowRange');
    if (glowRange) {
      glowRange.addEventListener('input', function() {
        document.documentElement.style.setProperty('--glow-intensity', this.value + 'px');
      });
    }

    // Chart
    const ctx = document.getElementById('graficoTransmisiones').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
        datasets: [{
          label: 'Transmisiones',
          data: [12, 19, 15, 17, 22, 30, 25],
          backgroundColor: 'rgba(157, 0, 255, 0.2)',
          borderColor: 'rgba(157, 0, 255, 1)',
          borderWidth: 2,
          tension: 0.4,
          pointBackgroundColor: 'rgba(157, 0, 255, 1)',
          pointBorderColor: '#111111',
          pointBorderWidth: 2,
          pointRadius: 5,
          pointHoverRadius: 7
        }, {
          label: 'Espectadores',
          data: [50, 82, 65, 90, 120, 150, 135],
          backgroundColor: 'rgba(255, 61, 189, 0.2)',
          borderColor: 'rgba(255, 61, 189, 1)',
          borderWidth: 2,
          tension: 0.4,
          pointBackgroundColor: 'rgba(255, 61, 189, 1)',
          pointBorderColor: '#111111',
          pointBorderWidth: 2,
          pointRadius: 5,
          pointHoverRadius: 7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(255, 255, 255, 0.05)'
            },
            ticks: {
              color: 'rgba(224, 224, 224, 0.8)'
            }
          },
          x: {
            grid: {
              color: 'rgba(255, 255, 255, 0.05)'
            },
            ticks: {
              color: 'rgba(224, 224, 224, 0.8)'
            }
          }
        },
        plugins: {
          legend: {
            position: 'top',
            labels: {
              boxWidth: 12,
              padding: 20,
              color: 'rgba(224, 224, 224, 0.8)'
            }
          }
        }
      }
    });