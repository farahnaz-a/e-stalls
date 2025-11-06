@push('js')
<script>
    $(document).ready(function () {
        $('[data-password="toggler"]').on('click', function(){
            let currentInput = $(this).closest('[data-password="wrapper"]').find('[data-password="input"]')
            if(currentInput.attr('type') == 'password'){
                $(this).find('[data-password="icon"]').attr('class', 'far fa-eye-slash')
                currentInput.attr('type', 'text')
            }else{
                $(this).find('[data-password="icon"]').attr('class', 'far fa-eye')
                currentInput.attr('type', 'password')
            }
        })
    });
</script>
@endpush
