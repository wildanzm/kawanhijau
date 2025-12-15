@props(['errors'])

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errors = @json($errors->all());
            let errorHtml = '<ul class="text-left space-y-2">';
            errors.forEach(error => {
                errorHtml +=
                    '<li class="flex items-start gap-2"><svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg><span>' +
                    error + '</span></li>';
            });
            errorHtml += '</ul>';

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: errorHtml,
                confirmButtonColor: '#018175',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'px-6 py-2 rounded-lg'
                }
            });
        });
    </script>
@endif
