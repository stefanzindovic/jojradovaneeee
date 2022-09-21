<!-- Core -->
<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
<!-- Optional JS -->
<script src="{{asset('assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('assets/js/dashboard.js?v=1.2.0')}}"></script>
<!-- Demo JS - remove this in your project -->
<script src="{{asset('assets/js/demo.min.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<!-- File upload -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/create-file-list"></script>

<!-- Datatables -->
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

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

<!-- Cropper -->
@vite('./resources/js/cropper/cropper.min.js')
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
@vite('./resources/js/dataTables.js')
@vite('./resources/js/main.js')
