@extends('layout.master')
@section('content')
<div class="container">
    <div class="search-container text-center mb-2">
        <form action="{{ route('attend.searchList') }}" method="post">
            @csrf
            @method('post')
            
            <div class="col-md-4">
                 <div class="input-group">
                    <div class="input-group-addon " id="calendar1">
                        <i class="fa fa-calendar fa-2x p-1 "></i>
                         
                    </div>
                           <input type="text" name="search" id="start_date" class="form-control start_date datepicker2" autocomplete="off">
                           <button  type="submit"><i class="fa fa-search " aria-hidden="true">Search</i></button>
                    </div>
                 
            </div>
            
<!--            <div class="col-4 input-group date" id="" data-target-input="nearest">
                <input type="text" class="form-control datepicker2 " data-target="" name="search" autocomplete="off" value="{{$request->key}}">
                <div class="input-group-append " data-target="" data-toggle="">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <button  class="w-10  p-2" type="submit"><i class="fa fa-search">Search</i></button>
            </div>-->
        </form>
    </div>  
</div>

<div class="container">
    <div class="tbl-handle table-sm ">
        <table class=" table table-striped table-hover table-light text-secondary font-weight-bold ">
            <thead class="bg-secondary text-warning">
                <tr>

                    <th  rowspan="2">Serial</th>

                    <th  rowspan="2">Employee</th>
                    <th rowspan="2">Address</th>
                    <th class="text-center" colspan="2">Attendance</th> 

                </tr>

                <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">Time</th>
                </tr>
            </thead>
            <tbody class="table-bordered">
                @php
                $serial=1;
                if(!$userList->isEmpty()){
                foreach($userList as $row){
                @endphp
                <tr>
                    <td>{{  $row->id }}</td>


                    <td> {{$row->first_name ?? ''}} </td>

                    <td>   
                        <button type="button" class="btn btn-info save-data "  data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal">
                            See Address
                        </button> 
                    </td>


                    <td class="text-center" disabled> 

                        {{date('d F,Y',strtotime($row->date))}}
                    </td>

                    <td class="text-center" disabled> 
                          {{date(' g:ia',strtotime($row->time))}}
                   
                        
                       

                    </td>
                </tr>
                @php } 
                }else{
                @endphp
                <tr>
                    <td>@lang('label.NO_DATA_FOUND')</td>
                </tr>
                @php }
                @endphp
            </tbody>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div id="showAddress">


                    </div>
                </div>
            </div>

        </table>


    </div>
</div>

<script type="text/javascript">
    
 
    $(document).ready(function() {
          $('#calendar1').click(function(event) {
            $('.start_date').datepicker('show');
          });
 });
    
    $(document).ready(function () {
        $(".datepicker2").datepicker({
            maxDate: new Date(),
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            dateFormat: "d MM,yy",
        });
    });

    $(".save-data").on('click', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{url('/attend/modal')}}",
            type: "POST",
            dataType: 'json',
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },

            success: function (res) {
                $('#showAddress').html(res.html);
            }
        });


    });
</script>

@endsection