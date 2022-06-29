@extends('layout.master')
@section('content')
    <div id="tableData" class="delRow text-dark container">

        <div class="row table p-2 text-center table-dark">
            <div class="col">Serial</div>
            <div class="col">Employee Name</div>
            <div class="col">Date</div>
            <div class="col">Time</div>
            <div class="col">Action</div>
        </div>


        <div class="row">
            <div class="col">
                <div class="input-group mb-3 text-align-center serial font-weight-bold" name="serial"
                    serial="{{ $i }}" id="serial">
                    {{ $i }}
                </div>

            </div>
            <div class="col">

                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        {!! Form::open() !!}
                        {{ Form::select('first_name', $details, null, ['class' => 'save-data form-select  w-100 p-2 ', 'id' => 'employee', 'name' => 'employee', 'placeholder' => 'Please select ...']) }}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>

            <div class="col">
                <div class="input-group mb-3" id="date">
                    <input name="date" type="date" class="form-control">
                </div>
            </div>

            <div class="col">
                <div class="input-group mb-3" id="time">
                    <input name="time" type="time" class="form-control">
                </div>
            </div>

            <div class="col ml-4"> <button type="button" class="addRow plus btn btn-success text-light"><i
                        class="fa-solid  fa-plus"></i>&nbsp;Add</button>
            </div>

        </div>

        <div id="newRow">
        </div>

    </div>

    <script>
        var check = [];
        $('select option').removeAttr('disabled');

        $(" select.save-data option:selected").each(function() {
            if ($(this).val() != '0') {
                var optionId = $(this).val();
                check.push(optionId);
            }

        });


        $(" select.save-data option").each(function() {

            $(this).attr('disabled', $.inArray($(this).val(), check) > -1 && !$(this).is(":selected"));
        });





        $(document).on('change', '.save-data', function() {
            var check = [];
            $('select option').removeAttr('disabled');

            $(" select.save-data option:selected").each(function() {
                if ($(this).val() != '0') {
                    var optionId = $(this).val();
                    check.push(optionId);
                }

            });


            $(" select.save-data option").each(function() {

                $(this).attr('disabled', $.inArray($(this).val(), check) > -1 && !$(this).is(":selected"));
            });

        });

        $(document).on('click', '.plus', function() {

            var i = $(".serial").last().attr('serial');
            $('select option').removeAttr('disabled');
            var employeeId = $("#employee").val();
            //console.log(employeeId);
            var val = '0';
            var check = [];
            $.ajax({
                url: "{{ url('/addRow') }}",
                type: "POST",
                dataType: 'json',
                cache: false,
                data: {
                    val: val,
                    i: i
                },

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    toastr.success(res.msg);
                    $('#newRow').append(res.html);

                    $(".serial").text(res.serial);

                    $(" select.save-data option:selected").each(function() {


                        if ($(this).val() != '0') {
                            var optionId = $(this).val();
                            check.push(optionId);
                        }

                    });


                    $(" select.save-data option").each(function() {

                        $(this).attr('disabled', $.inArray($(this).val(), check) > -1 && !$(this).is(":selected"));
                    });

                }
            });
        });

        $(document).on('click', '.drop', function() {
            //  $('.delRow').last().remove();
            $(this).closest('.delRow').remove();
            var i = 1;
            $(".serial").each(function() {
                $(this).html(i);
                $(this).attr('serial', i);
                i++;
            });

        });
    </script>
@endsection
