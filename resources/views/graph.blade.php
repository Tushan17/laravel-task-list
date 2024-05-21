@extends('layouts.app')

@section('title','graph')


@section('content')



<canvas id="myChart" style="width:100%;max-width:600px" ></canvas>

{{$graphs}}
<br>

{{$xarray}}
{{$yarray}}

<br>
@foreach ($graphs as $graph)

@if ($graph='x')

@endif


@endforeach










<script>


const XValues = <?php echo json_encode($xarray);?>;
const YValues = <?php echo json_encode($yarray);?>;

console.log('x',XValues);
console.log('y',YValues);



//empty array for processed data
var xValues=[];
var yValues=[];

//convert string to int inside an array
for (var i = 0; i < XValues.length; i++){
    if (XValues[i]>=0) {
        xValues.push(parseInt(XValues[i]));
    }
}

for (var i = 0; i < YValues.length; i++){
    if (YValues[i]>=0) {
        yValues.push(parseInt(YValues[i]));
    }
}


//insert 2 1-D arrays inside a 2d array
var graph=[];
for ( var i = 0; i < xValues.length; i++ ) {
  graph.push( [ xValues[i], yValues[i] ] );
}
console.log(graph);

//array is sorted by x values
const sortArr = (arr) => {
    arr.sort((valA, valB) => valA[0] - valB[0])
    return arr
}
sortArr(graph);


//empty both 1-D array and input x and y values to respective array
var xValues=[];
var yValues=[];
for (let i = 0; i < graph.length; i++) {
  for (let j = 0; j < graph[i].length; j++) {
    if (j==0) {
      xValues.push(graph[i][0]);
    } else {
      yValues.push(graph[i][1]);
    }

  }
}

//plot a graph using xValues and yValues; double line graph can be used for x:months
new Chart("myChart", {
  type: "line",
  data: {
    //1st dataset
    labels: xValues,
    datasets: [{
            fill: false,
            lineTension: 0,
            // backgroundColor: "rgba(0,0,255,1.0)",
            // borderColor: "rgba(0,0,255,0.1)",
            borderColor: "#123E54",
            data: yValues,
            label:"Line 1"
        }
        ,{
            //2nd dataset
            fill: false,
            lineTension: 0,
            // backgroundColor: "rgba(50,50,255,1.0)",
            // borderColor: "rgba(250,20,255,0.1)",
            borderColor: "#143892",
            data: [1,2,2,4],
            label:"Line 2"
        }
    ],

  },

  options: {
    legend: {display: true},

    title: {
        display: true,
        text: 'Graph title'
      },
    scales: {
      xAxes: [{
        // ticks: {min: 0, max:10},
         scaleLabel: {
            display: true,
            labelString: "x axis label"
          }
        // The axis for this scale is determined from the first letter of the id as `'x'`
        // It is recommended to specify `position` and / or `axis` explicitly.
        // type: 'time',
      }],
      yAxes: [{
        ticks: {min: 0, max:10},
        scaleLabel: {
            display: true,
            labelString: "y axis label"
          }
      }],
    }
  }
});
</script>





@endsection
