</div>
</div>
<footer class="bg-primary-system text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
          <h5>{{ $app_title }} (<i>For Educational Purposes Only</i>)</h5>

          <p>For any inquiries, please call 122 or email<br />helpdesk@quezoncity.gov.ph</p>
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0 d-flex align-items-center justify-content-end">
            <h5 class="text-small">
                Terms of Service | Privacy Policy | <i class="fab fa-facebook"></i> | <i class="fab fa-twitter"></i>
            </h5>
            
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    
  </footer>
  @include('partials.applicant.assets.fullscreenloader')


{{-- <script src="{{ asset('assets/adminlte3.2/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/toastr/toastr.min.js') }}"></script> 
<script src="{{ asset('assets/adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}s"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/confirm/js/jquery-confirm.js') }}"></script> --}}
{{-- 
<script src="{{ asset('assets/adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('scripts/modules/scripts.js') }}"></script> --}}

<script src="{{ asset('assets/adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/confirm/js/jquery-confirm.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3.2/dist/js/adminlte.js') }}"></script>
@include('components.chatbot-widget')
<script>
  $(document).ready(function () {
    if ($("[data-trigger=logout]").length) {
      $("[data-trigger=logout]").on("click", function () {
        ajaxRequest("/executor/applicant/logout", {});
      });
    }
  });
</script>
</body>
</html>