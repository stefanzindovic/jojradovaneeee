<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

<!-- Custom -->
@vite('./resources/js/autoUpdatePolicy.js')
@vite('./resources/js/dataTables.js')
@vite('./resources/js/app.js')
