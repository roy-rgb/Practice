@extends('layout.master')
@section('content')
    <table id="tableData" class="table delRow text-dark container">
        <thead>
            <tr>
                <th>Serial</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="input-group mb-3  text-center serial font-weight-bold  h3" name="serial"
                        serial="{{ $i }}" id="serial">
                        {{ $i }}
                    </div>

                </td>
                <td>

                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            {!! Form::open() !!}
                            {{ Form::select('first_name', $details, null, ['class' => 'save-data form-select  w-100 p-2 ', 'id' => 'employee', 'name' => 'employee', 'placeholder' => 'Please select ...']) }}
                            {!! Form::close() !!}
                        </div>
                    </div>

                </td>

                <td>
                    <div class="input-group mb-3" id="date">
                        <input name="date" type="date" class="form-control">
                    </div>
                </td>

                <td>
                    <div class="input-group mb-3" id="time">
                        <input name="time" type="time" class="form-control">
                    </div>
                </td>

                <td> <button type="button" class="addRow plus btn btn-success text-light"><i
                            class="fa-solid fa-plus"></i>&nbsp;Add</button>
                </td>

            </tr>



        </tbody>

    </table>
    <div id="newRow">

    </div>

    <script>
        /*$(".save-data").each(function () {
                                                var employeeId = $(this).val();
                                                var options = $("#employee option[value='" + employeeId + "']");
                                                //options.attr('disabled', 'true');
                                            });*/





        $(document).on('change', '.save-data', function() {
            var check = [];
            $('select option').removeAttr('disabled');
            // var val = $(this).attr('id');
            //  var val = $(this).val();
            //  if(employee!=''){
            // var val = $('.save-data').find(":selected").val();
            //        //var value =  $(".save-data option: selected");
            //        alert(val);
            //  alert(val);
            //        // }
            //        if (val != '') {
            //            var options = $(".delRow option[value='" + val + "']");
            //            options.attr('disabled', 'true');
            //        }

            $(" select.save-data option:selected").each(function() {
                //var value = $(this).val();
                //console.log(value);
                //  var kal = $(this).find(":selected").val();

                if ($(this).val() != '0') {
                    var optionId = $(this).val();
                    check.push(optionId);
                }
                // check.push(value);
                // console.log(check);
                //console.log(check.toString());
            });


            $(" select.save-data option").each(function() {
                // var kal = $(this).find(":selected").val();
                // console.log(kal);
                // var options = $("#employee option[value='" + employeeId + "']");
                // if (jQuery.inArray(kal, check)) {
                //      options.prop('disabled', 'true');
                //  }
                $(this).attr('disabled', $.inArray($(this).val(), check) > -1 && !$(
                    this).is(":selected"));
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
                    // var kal = $('.save-data').find(":selected").val();
                    // check.push(kal);
                    // console.log(check.toString());
                    $(".serial").text(res.serial);

                    $(" select.save-data option:selected").each(function() {
                        //var value = $(this).val();
                        //console.log(value);
                        //  var kal = $(this).find(":selected").val();

                        if ($(this).val() != '0') {
                            var optionId = $(this).val();
                            check.push(optionId);
                        }
                        // check.push(value);
                        // console.log(check);
                        //console.log(check.toString());
                    });


                    $(" select.save-data option").each(function() {
                        // var kal = $(this).find(":selected").val();
                        // console.log(kal);
                        // var options = $("#employee option[value='" + employeeId + "']");
                        // if (jQuery.inArray(kal, check)) {
                        //      options.prop('disabled', 'true');
                        //  }
                        $(this).attr('disabled', $.inArray($(this).val(), check) > -1 && !$(
                            this).is(":selected"));
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
