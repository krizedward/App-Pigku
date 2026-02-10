<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>
        Copyright &copy; Pigkupigku.com 
        <span id="year-range"></span>
      </span>
    </div>
  </div>
</footer>


<script>
  const startYear = 2025;
  const currentYear = new Date().getFullYear();

  const yearText = startYear === currentYear
    ? startYear
    : `${startYear} - ${currentYear}`;

  document.getElementById("year-range").textContent = yearText;
</script>
<!-- End of Footer -->