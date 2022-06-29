<div class="row  delRow text-dark">
            <div class="col">
                <div class="input-group mb-3 serial font-weight-bold text-align-center" serial="{{ $i }}" name="serial" id="serial">
                            {{ $i }}
                </div>

            </div>
            <div class="col">

                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        {!! Form::open() !!}
                        {{ Form::select('first_name', $details, null, ['class' => 'save-data   form-select  w-100 p-2 ', 'id' => 'employee', 'name' => 'employee', 'placeholder' => 'Please select ...']) }}
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

            <div class="col  ml-4"> <button type="button" style="background-color:red;" class="addRow drop btn btn-warning text-light"><i
                        class="fa-solid fa-xmark"></i>&nbsp;Drop</button>
            </div>


        </div>
