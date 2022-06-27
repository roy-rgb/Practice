@extends('layout.master');

@section('content')
<div class="tbl-handle table-sm ">
    <table class="table table-hover table-striped table-light text-secondary font-weight-bold ">
        <thead class="bg-secondary text-warning">
            <tr>
                <th>Serial</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th> 
                <th>Gender</th>   
                <th>Status</th>     
                <th>Status Change</th>
                <th>Image</th>




                <td colspan="2"><b>Action</b></td>   
            </tr>
        </thead>

        @php
        $serial=1;
        $statusColor = '';
        foreach($user as $row){
        $statusColor = $row->status == 1 ? 'btn-success' : 'btn-danger';
        @endphp

        <tbody class="table-bordered">
            <tr>

                <td> {{ $serial++ }}  </td>
                <td> {{$row->first_name}} </td>
                <td>  {{ $row->last_name }}  </td>
                <td>  
                    {{ $row->address }}

                </td>

                <td id="btn-gender{{$row->id}}"> {{ ($row->gender == '1') ? 'Male' : ' Female' }}   </td> 

                <td id="btnStatus_{{$row->id}}"> {{($row->status == '0') ? 'Inactive' : ' Active' }}</td>

                <td> <button type="button" style="width: 100px" id="statusChangeBtn_{{$row->id}}" class="btn btn-block save-data {{$statusColor}}"  data_id="{{$row->id}}" stat_id="{{$row->status}}"> {{ ($row->status == '0') ? 'Activate' : 'Deactivate' }}  </button></td>

                <td>
                    <img src="{!! asset('public/uploads/' . $row->image) !!}" alt="Smiley face" width="70" height="42" style="border:2px solid white">
                </td>

                <td>     
                    <a  href="{{ route('userEdit', $row->id)}}"> <button class="bg-info" > <i class="fa-solid fa-edit"></i> </button> </a> </td>
                <td>
                    <a  href="{{ route('userDestroy', $row->id)}}"onclick="return confirm('Are you sure to Delete?')"> <button class="bg-danger"><i class="fa-solid fa-trash-can"></i></button> </a>
                </td>

            </tr>
        </tbody>


        @php } @endphp





    </table>
</div>


<script>


    $(document).on('click', '.save-data', function () {
        let text = "Do you want to change!\nPress a button!\nEither OK or Cancel.";
        if (confirm(text) == true) {

            var id = $(this).attr('data_id');
            var status = $(this).attr('stat_id');
            //window.alert(id);
            //window.alert(status);

            $.ajax({
                url: "{{URL::to('/status')}}",
                type: "POST",
                dataType: 'json',
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    status: status
                },

                success: function (res) {

                    if (status == 1) {
                        $('#btnStatus_' + id).html("Inactive");
                        $('#statusChangeBtn_' + id).removeClass('btn-success');
                        $('#statusChangeBtn_' + id).addClass('btn-danger');
                        $('#statusChangeBtn_' + id).text('Activate');
                        $('#statusChangeBtn_' + id).attr('stat_id', 0);
                    }
                    if (status == 0) {
                        $('#btnStatus_' + id).html("Active");
                        $('#statusChangeBtn_' + id).removeClass('btn-danger');
                        $('#statusChangeBtn_' + id).addClass('btn-success');
                        $('#statusChangeBtn_' + id).text('Deactivate');
                        $('#statusChangeBtn_' + id).attr('stat_id', 1);
                    }

                }
            });
        }

    });




</script>




@endsection