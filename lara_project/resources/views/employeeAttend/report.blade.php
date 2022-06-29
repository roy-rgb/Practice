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


    <div class="report-container">

        <table class="table table-bordered table-responsive-sm">


            <thead>

                <tr>
                    <th>Employee Name</th>


                    @php for($i=1;$i<=$range;$i++){ @endphp <th>
                        @php echo $i; @endphp
                        </th>
                        @php }@endphp

                </tr>

            </thead>

            @php
            foreach($details as $row ){
            @endphp

            <tbody>
                <tr>
                    <td>{{ $row->first_name }}</td>
                </tr>

            </tbody>
            @php } @endphp
        </table>
    </div>
</div>
@endsection
