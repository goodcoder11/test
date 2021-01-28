@extends('layouts.admin')

@section('content')

    <div>
        Hello Admin!
    </div>

    @include('includes.tasks-section')

@endsection

@section('javascript')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.tasks-cb-td input[type="checkbox"]').on('change', function (e) {
            e.preventDefault();

            let status = $(this).prop('checked');
            let id = $(this).data('id');

            $.ajax({
                type: 'POST',   // Define the type of HTTP verb we want to use
                url: '{{ route('admin.task-status-update') }}',   // The URL where we want to POST
                data: {id: id, status: (status + 0)}, // Our data object
                dataType: 'json',   // What type of data do we expect back.
                success: function (response) {
                    if (response.success === true) {
                        $('.task-status-info-' + id).text(response.message);
                    } else {
                        $(this).prop('checked', !status);
                        alert('Try again!');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Something went wrong!');
                    // If any error occurs in request
                }
            });

        });
    </script>
@endsection
