<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Invoice</title>
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('public/dist/js/printThis.js') }}"></script>

</head>

<body>


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
                    $statusColor = !empty($attendList[$empId][$day]) ? 'btn-success' : 'btn-danger';
                    @endphp

                    @php
                    $checkPresent = !empty($empId) && !empty($attendList[$empId][$day]) ;
                    $color ='text-danger';
                    $isPresent ='.';
                    if( $checkPresent){
                    $color='text-success';
                    $isPresent ='p';
                    }
                    @endphp

                    <td>
                        <span class="{{ $color }} font-weight-bold">{{ $isPresent}}</span>
                    </td>
                    @php }} @endphp
                </tr>
                @php }} @endphp
            </tbody>


        </table>
    </div>

    </div>
    <script>


        // $(document).ready(function(){

        //             $(".btnprn").printThis({
        //                 debug: false,               // show the iframe for debugging
        //                 importCSS: true,            // import parent page css
        //                 importStyle: false,         // import style tags
        //                 printContainer: true,       // print outer container/$.selector
        //                 loadCSS: "",                // path to additional css file - use an array [] for multiple
        //                 pageTitle: "",              // add title to print page
        //                 removeInline: false,        // remove inline styles from print elements
        //                 removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
        //                 printDelay: 333,            // variable print delay
        //                 header: null,               // prefix to html
        //                 footer: null,               // postfix to html
        //                 base: false,                // preserve the BASE tag or accept a string for the URL
        //                 formValues: true,           // preserve input/form values
        //                 canvas: false,              // copy canvas content
        //                 doctypeString: '...',       // enter a different doctype for older markup
        //                 removeScripts: false,       // remove script tags from print content
        //                 copyTagClasses: false,      // copy classes from the html & body tag
        //                 beforePrintEvent: null,     // function for printEvent in iframe
        //                 beforePrint: null,          // function called before iframe is filled
        //                 afterPrint: null
        //             });


        //     });

            window.addEventListener('DOMContentLoaded', function() {
            window.print();
        });

    </script>


</body>

</html>
