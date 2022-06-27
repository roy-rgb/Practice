@extends('layout.master')

@section('content')

<form action="{{ route('userUpdate', $empEdit->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="card-body">

        <div class="form-group">
            <label for="firstName">@lang('level.fname')</label>
            <input  class="form-control" name="firstName" id="exampleInputEmail1" value="{{ $empEdit->first_name }}" >
        </div>

        <div class="form-group">
            <label for="lastName">@lang('level.lname')</label>
            <input  class="form-control" name="lastName" id="exampleInputEmail1" value="{{ $empEdit->last_name }}" >
        </div>


        <div class="form-group">
            <label for="address">@lang('level.address')</label>
            <input  class="form-control" name="address" id="exampleInputEmail1"  value="{{ $empEdit->address }}" >
        </div>




        <div class="form-group  ">
            <label for="gender"  >@lang('level.gender')</label>
            <div class="col-md-6 ">
                <input type="radio" name="gender"  value="1"  @php  echo ($empEdit->gender == 1) ?  'checked' : "" ; @endphp >Male
                       <input type="radio" name="gender"  value="2"   @php  echo ($empEdit->gender == 2) ?  'checked': "" ;  @endphp >Female

                       <div>
                </div>

                <div class="form-group ">
                    <label for="status"  >@lang('level.status')</label>

                    <div class="col-md-6 ">


                        <input type="radio" name="status"  value="1"  @php echo ($empEdit->status == 1)? 'checked': ""; @endphp >Active
                               <input type="radio" name="status"  value="0" @php echo ($empEdit->status == 0)  ?'checked': ""; @endphp >Inactive

                               <div>
                        </div>



                        <div class="form-group">
                            <label for="exampleInputFile">@lang('level.image')</label>
                            <div class="input-group 
                                 ">
                                <img src="{{asset('/public/uploads/' . $empEdit->image) }}" alt="Smiley face" width="70" height="42" style="border:2px solid white">

                                <div class="custom-file ">

                                    <input type="file" name="file"class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    @endsection