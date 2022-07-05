@extends('layout.master')
@section('content')

@php
$statusColor ='';
@endphp
<div class="container">
    <div class="search-container ">
        <form action="{{ route('reportSearch') }}" method="post">
            @csrf
            @method('post')
            {!! Form::select('year', $year, $ryear ?? null, ['class' => 'col-2 w-100 p-2 ', 'id' => 'year', 'name' => 'year',
            'placeholder' => 'Please select ...']) !!}
            {!! Form::select('month', $month, $rmonth??null, ['class' => 'col-2 w-100 p-2 ', 'id' => 'month', 'name' => 'month',
            'placeholder' => 'Please select ...']) !!}

            <button class="h4" type="submit">Search</button>
        </form>
    </div>



    <div class="mb-5"></div>


    @if(Request::get('generate')=='true')

    <div class="pdf-container">
        {{--
        <a href="{{ URL::full().'&download=pdf'}}" class="btn btn-outline-success" type="button" name="search">
            Generate PDF --}}



            <div class="row row justify-content-md-end ">
                <a href="{{ URL::full().'&download=pdf'}}"><i class="fa fa-file-pdf fa-3x p-2 text-danger"></i></a>
                <a href="{{ URL::full().'&document=print'}}" class="btnprn" type="button"><i
                        class="fa fa-print fa-3x p-2 text-warning "></i></a>
            </div>

    </div>
    <div class="report-container">
        <div class="p-2 h4 bg-info font-weight-bold">
            {{-- str_pad($i, 2, '0', STR_PAD_LEFT) --}}
            @php
            echo "Year:".$ryear." , "."Month:".$month[$rmonth] ;
            @endphp
        </div>

        <table class="table table-bordered table-responsive-sm">


            <thead>

                <tr>
                    <th>Employee Name</th>
                    @if(!empty($dayArr))
                    @foreach($dayArr as $dI => $day)
                    <th> {{ $day }}</th>

                    @endforeach
                    @endif

                </tr>

            </thead>


            <tbody>
                @if(!empty($empList))
                @foreach($empList as $empId => $emp)
                <tr>
                    <td>{{ $emp }} </td>

                    @if(!empty($dayArr))
                    @foreach($dayArr as $dI => $day)

                    <?php
                    $color ='text-danger';
                    $isPresent = (strtotime(date($ryear . '-' . $rmonth . '-' . $day)) < strtotime(date('Y-m-d'))) ? '.' : '' ;
                    if(!empty($empId) && !empty($attendList[$empId][$day])){
                        $color='text-success' ;
                        $isPresent='p';
                    }
                    ?>
                    <td>
                        <span class="{{ $color }} font-weight-bold">{{ $isPresent}}</span>
                    </td>
                    @endforeach
                    @endif
                </tr>
                @endforeach
                @endif
            </tbody>


        </table>
    </div>
    @endif

</div>

<script>
    // $("button").click(function(){
                //     $(".btnprn").printThis();
                // });

           // });
    // $(".cngcolor").each(function() {
//     if($(this).html('p')== true){
//         $('this).addClass('btn-success');
//     }
// }
</script>

@endsection
