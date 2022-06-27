@extends('layout.master')

@section('content')

<form action="{{route('attend.store')}} " method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div class="container">
        <div class="tbl-handle table-sm ">
            <table class=" table  bgm table-striped table-hover table-light text-secondary font-weight-bold " id="pk" >
                <thead class="bg-secondary text-warning">
                    <tr>
                        <th>
                            <label class="text-warning">
                                <input id="selectCheckAll" class="check" type="checkbox"/>
                                Check All</label> 
                        </th> 
<!--                        <th  rowspan="2">Check</th>-->
                        <th>Employee</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Time</th>

                    </tr>


                </thead>

                <tbody class="table-bordered  ">

                    @php
                    $serial=1;
                    if(!$user->isEmpty()){
                    foreach($user as $row){

                    @endphp
                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input name="employee_id[{{$row->id}}]" type="checkbox" data-id="{{$row->id}}" class="custom-control-input emp-check" id="{{$row->id}}" value="{{$row->id}}">
                                <label class="custom-control-label" for="{{$row->id}}">{{  $serial++ }}</label>
                            </div>
                        </td>

                        <td> {{$row->first_name}} </td>

                        <td class="text-center" > 

                            Date: <input type="date" name="date[{{$row->id}}]" id="date_{{$row->id}}" class=" date-time" autocomplete="off" disabled> 
                        </td>

                        <td class="text-center">  
                            Time: <input type="time" class="date-time " name="time[{{$row->id}}]" id="time_{{$row->id}}" disabled> 
                        </td>



                    </tr>
                    @php }}else{ @endphp
                    <tr>
                        <td>@lang('label.Please Enter data')</td>
                    </tr>
                    @php }
                    @endphp

                </tbody>


            </table>


        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<script>

    $(document).ready(function () {
        $('#pk').DataTable({
            'sort': false,
        });

        $("#selectCheckAll").on('click', function () {
            if (this.checked == true) {
                $(".emp-check").prop('checked', true);
                $(".date-time").prop('disabled', false);
            } else {
                $(".emp-check").prop('checked', false);
                $(".date-time").prop('disabled', true);
            }
        });

        $(".emp-check").on('click', function () {
            var id = $(this).attr('data-id');
            // alert(id);
            if (this.checked == true) {
                $("#date_" + id).prop('disabled', false);
                $("#time_" + id).prop('disabled', false);
            } else {
                $("#date_" + id).prop('disabled', true);
                $("#time_" + id).prop('disabled', true);
            }

            if ($('.emp-check:checked').length == $('.emp-check').length) {
                $('#selectCheckAll').prop('checked', true);
            }
            if ($('.emp-check:checked').length != $('.emp-check').length) {
                $('#selectCheckAll').prop('checked', false);
            }

        });








    });



</script>


@endsection