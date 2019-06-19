<div class="fixed-action-btn">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">add</i>
    </a>
    <ul>
        @stack('fab_buttons')
    </ul>
</div>

@push('end')
<script>
    $(document).ready(function(){
        $('.fixed-action-btn').floatingActionButton({
            hoverEnabled: false
        });
    });
</script>
@endpush
