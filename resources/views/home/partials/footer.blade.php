<footer>
  <div class="container">
    <div class="col-lg-8">
      <p>&copy; {{ date('Y') }} SMAN PLUS PROVINSI RIAU. All rights reserved.</p>
    </div>
  </div>
</footer>

<!-- Vendor Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Plugin Scripts -->
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/counter.js') }}"></script>

<!-- Custom Scripts -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Inline Styles -->
<style>
  /* ===== Card & Stats ===== */
  .card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    width: 260px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: "Poppins", sans-serif;
    margin-bottom: 15px;
  }

  .label {
    color: #9ca3af;
    font-size: 14px;
    margin: 0;
  }

  .value {
    font-size: 18px;
    font-weight: 700;
    margin: 5px 0 0;
  }

  .divider {
    border-bottom: 1px solid #e5e7eb;
    margin: 10px 0;
  }

  /* ===== Registration Form ===== */
  .registration-form {
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .registration-form .form-group {
    margin-bottom: 18px;
  }

  .registration-form label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    color: #333;
  }

  .registration-form .form-control,
  .registration-form .form-control-file,
  .registration-form select {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 15px;
  }

  .btn-submit {
    background: #800000;
    color: #fff;
    padding: 14px 30px;
    border-radius: 50px;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: 0.3s;
    font-size: 16px;
  }

  .btn-submit:hover {
    background: #dd0202ff;
  }

  /* ===== Alerts ===== */
  .alert {
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
  }

  .alert-success {
    background: #d4edda;
    color: #155724;
  }

  .alert-danger {
    background: #f8d7da;
    color: #721c24;
  }
</style>

<!-- ===== Isotope Filtering ===== -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Isotope
    var iso = new Isotope('#isotope-grid', {
      itemSelector: '.properties-items',
      layoutMode: 'fitRows',
      transitionDuration: '0.4s'
    });

    // Filter buttons
    document.querySelectorAll('.properties-filter a').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        // Remove active class from all buttons
        document.querySelectorAll('.properties-filter a').forEach(a => a.classList.remove('is_active'));
        // Add active class to clicked button
        this.classList.add('is_active');

        // Filter items
        var filterValue = this.getAttribute('data-filter');
        iso.arrange({
          filter: filterValue
        });
      });
    });
  });
</script>