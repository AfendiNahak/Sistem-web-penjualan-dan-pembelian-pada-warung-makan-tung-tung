@extends('layouts.main')

@section('container')

@include('profile.partials.update-profile-information-form')
@include('profile.partials.update-password-form')
@include('profile.partials.delete-user-form')

<script>
    $(document).ready(function() {
        $(".toggle_hide_password").on('click', function(e) {
            e.preventDefault() 
            var input_group = $(this).closest('.input-group')
            var input = input_group.find('input.form-control')  
            var icon = input_group.find('i')
            input.attr('type', input.attr("type") === "text" ? 'password' : 'text')
            icon.toggleClass('fa-eye-slash fa-eye')
        })
        })
</script>

@endsection