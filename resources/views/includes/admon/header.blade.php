<nav class="main-header">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" id="toggle-sidebar" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
   
    <!-- Fullscreen -->
    <li class="nav-item">
      <a class="nav-link" id="fullscreen-btn" href="#" role="button" onclick="toggleFullscreen()">
      <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>

    <script>
      function toggleFullscreen() {
      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
        console.error(`Error attempting to enable fullscreen mode: ${err.message}`);
        });
      } else {
        document.exitFullscreen().catch(err => {
        console.error(`Error attempting to exit fullscreen mode: ${err.message}`);
        });
      }
      }
    </script>
  </ul>
</nav>
