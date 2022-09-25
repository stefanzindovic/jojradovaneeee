<script src="{{asset('dashboardfiles/assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" charset="utf8" src={{asset('dashboardfiles/vendor/datatable/datatables.js')}}></script>
<script src="{{asset('assets/js/cropper.min.js')}}"></script>
<script src="{{asset('dashboardfiles/vendor/@popperjs/core/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('dashboardfiles/vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Vendor JS -->
<script src="{{asset('dashboardfiles/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>

<!-- Smooth scroll -->
<script src="{{asset('dashboardfiles/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>

<!-- Charts -->
<script src="{{asset('dashboardfiles/vendor/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('dashboardfiles/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>

<!-- Datepicker -->
<script src="{{asset('dashboardfiles/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('dashboardfiles/assets/js/multi.js')}}"></script>
<!-- Sweet Alerts 2 -->
<script src="{{asset('dashboardfiles/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>

<script src="{{asset('dashboardfiles/assets/js/ckeditor.js')}}"></script>
<!-- Moment JS -->
<script src="{{asset('dashboardfiles/assets/js/moment.min.js')}}"></script>

<!-- Vanilla JS Datepicker -->
<script src="{{asset('dashboardfiles/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>

<!-- Notyf -->
<script src="{{asset('dashboardfiles/vendor/notyf/notyf.min.js')}}"></script>

<!-- Simplebar -->
<script src="{{asset('dashboardfiles/vendor/simplebar/dist/simplebar.min.js')}}"></script>

<!-- Github buttons -->
<script async defer src="{{asset('dashboardfiles/assets/js/buttons.js')}}"></script>

<!-- Volt JS -->
<script src="{{asset('dashboardfiles/assets/js/volt.js')}}"></script>


<script src="{{asset('dashboardfiles/vendor/choices/choices.min.js')}}"></script>

<script src="{{asset('dashboardfiles/vendor/notyf/notyf.min.js')}}"></script>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

{{-- Chartjs --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
    integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- File upload -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/create-file-list"></script>

<!-- Validations -->
@vite('./resources/js/validations/policyInputsRestrictions.js')
@vite('./resources/js/validations/categoriesValidation.js')
@vite('./resources/js/validations/genresValidation.js')
@vite('./resources/js/validations/publishersValidations.js')
@vite('./resources/js/validations/coversValidation.js')
@vite('./resources/js/validations/formatsValidation.js')
@vite('./resources/js/validations/scriptsValidation.js')
@vite('./resources/js/validations/languageValidation.js')
@vite('./resources/js/validations/authorsValidation.js')
@vite('./resources/js/validations/studentsValidations.js')
@vite('./resources/js/validations/librariansValidation.js')
@vite('./resources/js/validations/passwordsValidation.js')
@vite('./resources/js/validations/booksValidation.js')
@vite('./resources/js/validations/reserveBookValidation.js')
@vite('./resources/js/validations/issueBookValidation.js')

@vite('./resources/js/cropper.js')

<!-- Navigation tabs -->
@vite('./resources/js/booksTabNavigation.js')
@vite('./resources/js/bookRecordsTabNavigation.js')
@vite('./resources/js/userProfileTabsNavigation.js')
@vite('./resources/js/userRecordsTabNavigation.js')

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@vite('./resources/js/multipleSelect.js')

<!-- Custom -->
@vite('./resources/js/autoUpdatePolicy.js')
@vite('./resources/js/deleteOldPictureFromMultimedia.js')
@vite('./resources/js/main.js')
