<div class="fixed-action-btn">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">add</i>
    </a>
    <ul>
        <li><a class="btn-floating green"><i class="material-icons">playlist_add</i></a></li>
        <li><a class="btn-floating red"><i class="material-icons">library_add</i></a></li>
        <li><a class="btn-floating yellow darken-2"><i class="material-icons">person_add</i></a></li>
    </ul>
</div>

@push('end')
<script>
    $(document).ready(function(){
        $('.fixed-action-btn').floatingActionButton();
    });
</script>
@endpush
