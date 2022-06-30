@extends('layout.master')
@section('content')
<div class="container">
    <div class="search-container ">
        <form action="{{ route('reportSearch') }}" method="post">
            @csrf
            @method('post')
            {!! Form::select('year', $year, null, ['class' => 'col-2 w-100 p-2 ', 'id' => 'year', 'name' => 'year',
            'placeholder' => 'Please select ...']) !!}
            {!! Form::select('month', $month, null, ['class' => 'col-2 w-100 p-2 ', 'id' => 'month', 'name' => 'month',
            'placeholder' => 'Please select ...']) !!}

            <button class="h4" type="submit">Search</button>
        </form>
    </div>

    <div class="mb-5"></div>


    @if(Request::get('generate')=='true')
    <div class="report-container">

        <table class="table table-bordered table-responsive-sm">


            <thead>

                <tr>
                    <th>Employee Name</th>
                    @php
                    if(!empty($dayArr)){
                    foreach($dayArr as $dI => $day){
                    @endphp

                    <th> {{ $day }}</th>

                    @php }} @endphp

                </tr>

            </thead>


            <tbody>
                @php
                if(!empty($empList)){
                foreach($empList as $empId => $emp){
                @endphp
                <tr>
                    <td>{{ $emp }} </td>

                    @php
                    if(!empty($dayArr)){
                    foreach($dayArr as $dI => $day){
                    @endphp

                    <td>
                        @php echo !empty($empId) && !empty($attendList[$empId][$day]) ? 'P' : '.'; @endphp
                    </td>
                    @php }} @endphp
                </tr>
                @php }} @endphp
            </tbody>


        </table>
    </div>
    @endif

</div>
@endsection
