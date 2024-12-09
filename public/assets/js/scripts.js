<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

$.ajaxSetup({
    headers:{
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$(document).ready(function(){
    alert('hhh');
    $('#create-todo').click(function (e) {
        e.preventDefault();
        $('#todo-modal').modal("toggle")

    });
});
