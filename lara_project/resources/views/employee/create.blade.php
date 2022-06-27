@extends('layout.master')

@section('content')

<form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div class="card-body">

        <div class="form-group">
            <label for="firstName">@lang('level.fname')</label>
            <input  class="form-control" name="firstName" id="exampleInputEmail1" placeholder="Enter First name">
        </div>

        <div class="form-group">
            <label for="lastName">@lang('level.lname')</label>
            <input  class="form-control" name="lastName" id="exampleInputEmail1" placeholder="Enter Last name">
        </div>

        <div class="form-group">
            <label for="address">@lang('level.address')</label>
            <input  class="form-control" name="address" id="exampleInputEmail1" placeholder="Enter address">
        </div>

        <div class="form-group">

            <label for="division">@lang('level.division')</label>
            <div class="col-md-6">
        {{ Form::select('name', $division, null, array('class'=>' save-data form-control  w-50 p-2 rounded','id'=>'division','name'=>'division', 'placeholder'=>'Please select ...')) }}

            </div>


        </div>

        <div class="form-group ">
            <label for="district" >@lang('level.district')</label>
            <div class="col-md-6">
                <select class="w-50 p-2 rounded save-data2" name="district" id="district" >
                    <option value="0">Select District</option>
                </select>
            </div>
        </div>


        <div class="form-group ">
            <label for="thana" >@lang('level.thana')</label>
            <div class="col-md-6">
                <select class="w-50 p-2 rounded" name="thana" id="thana" >
                    <option value="0">Select Thana</option>
                </select>
            </div>
        </div>



        <div class="form-group  ">
            <label for="gender"  >@lang('level.gender')</label>
            <div class="col-md-6 ">
                <input  type="radio" id="male" name="gender" value="1"><label for="male">Male</label>  
                <input  type="radio" id="female" name="gender" value="2"><label for="female">female</label>
                <div>
                </div>

                <div class="form-group ">
                    <label for="status"  >@lang('level.status')</label>
                    <div class="col-md-6 ">
                        <input  type="radio" id="active" name="status" value="1"><label for="active">Active</label>  
                        <input  type="radio" id="inactive" name="status" value="0"><label for="inactive">Inactive</label>
                        <div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">@lang('level.image')</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file"class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">@lang('level.eAddress')</label>
                            <input type="email" class="form-control" name="email"id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">@lang('level.pass')</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>

                    <script>

                        $(".save-data").on('change', function () {
                            document.getElementById("district").innerHTML = "<option value='0'>Select District</option>";
                            document.getElementById("thana").innerHTML = "<option value='0'>Select Thana</option>";
                            var id = $('#division').val();
                            //  window.alert(id);
                            //var id = $(this).attr('data-id');
                            $.ajax({
                                url: "{{url('/district')}}",
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
                                    $('#district').html(res.html);
                                }
                            });


                        });



                        $(".save-data2").on('change', function () {

                            var id = $('#district').val();
                            // window.alert(id);
                            //var id = $(this).attr('data-id');
                            $.ajax({
                                url: "{{url('/thana')}}",
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
                                    $('#thana').html(res.html);
                                }
                            });


                        });










                        //    
                        //        function showDistrict(divisionId) {
                        //        document.getElementById("district").innerHTML = "<option value='0'>Select District</option>";
                        //
                        //        if (divisionId == " ") {
                        //            document.getElementById("district").innerHTML = "no found";
                        //            return;
                        //        }
                        //
                        //
                        //
                        //        const xhttp = new XMLHttpRequest();
                        //        //xhttp.open("GET", "district?id=" + divisionId);
                        //
                        //        xhttp.open("GET", "{{ url('district')}}" + '/' + divisionId);
                        //        xhttp.send();
                        //        xhttp.onload = function () {
                        //            document.getElementById("district").innerHTML = this.responseText;
                        //
                        //        }
                        //    }
                        //
                        //
                        //function showTha(thanaId) {
                        //        //console.log(divisionId);return false;
                        //        if (thanaId == " ") {
                        //            document.getElementById("thana").innerHTML = "no found";
                        //            return;
                        //        }
                        //
                        //
                        //        const xhttp = new XMLHttpRequest();
                        //        xhttp.open("GET", "{{ url('thana')}}" + '/' + thanaId);
                        //        xhttp.send();
                        //        xhttp.onload = function () {
                        //            document.getElementById("thana").innerHTML = this.responseText;
                        //
                        //        }
                        //    }

                    </script>





                    @endsection