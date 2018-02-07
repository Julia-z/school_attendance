@extends('layouts.dashboard')

@section('content')

    <style>
    th, td {
        padding: 5px;
        text-align: left;
        }
    thead th, thead td {
        text-align: center;;
    }
    .layout{
      overflow-x: scroll;
    }
    </style>


    @foreach($tasks_data as $batches)
        <h3>Data for truck: {{ $batches->meta }}m<sup>3</sup> </h2>
        @foreach($batches->data as $batch=>$tasks)
            <h4>
                Batch #{{ $batch + 1 }} assigned at {{ (new DateTime($tasks->meta))->format('H:i:s') }}
                <a  onclick="window.open(this.href, 'preview','left=20,top=20,width=800,height=500,toolbar=1,resizable=0'); return false;" href="tanks_preview?{{$tasks->preview_link}}">(Map)</a>
            </h3>

            <table border="1" style="border-collapse: collapse;">

                <thead>
                    <tr>
                        <th colspan="1">Metadata</th>
                        <th colspan="4">Last Sweep Event</th>
                        <th colspan="3">Volumes </th>
                        <th colspan="8">Task Event</th>
                    </tr>
                    <tr>
                        <td style="border: 0px;">Tank (Capacity - m<sup>3</sup>)</td>
                        <td>Timestamp</td>
                        <td>Sweep Measurement 2 for Black</td>
                        <td>Sweep Measurement 2 for Color</td>
                        <td>Initial Estimated Volume (m<sup>3</sup>)</td>
                        <td>Volume Increase (m<sup>3</sup>)</td>
                        <td>Current Estimated Volume (m<sup>3</sup>)</td>
                        <td>Fill Level (%)</td>
                        <td>Task Done?</td>
                        <td>Task Completion Timestamp</td>
                        <td>Measurement 1 for Black</td>
                        <td>Measurement 2 for Black</td>
                        <td>Measurement 1 for Color</td>
                        <td>Measurement 2 for Color</td>
                        <td>Volume Before Desludging <br/> (m<sup>3</sup>)</td>
                        <td>Desludged Volume <br/> (m<sup>3</sup>)</td>
                    <tr/>
                </thead>

                <tbody>
                    @foreach($tasks->data as $task)
                        <tr>
                            <th>{{ $task->tank }}</th>
                            <th>{{ $task->previous_timestamp }}</th>
                            <th>{{ $task->previous_measure_b }}</th>
                            <th>{{ $task->previous_measure_c }}</th>
                            <th>{{ $task->previous_volume }}</th>
                            <th>{{ $task->fillrate_volume }}</th>
                            <th>{{ $task->total_volume }}</th>
                            <th>{{ $task->previous_fill_per }}</th>
                            <th>{{ $task->done }}</th>
                            <th>{{ $task->curr_timestamp }}</th>
                            <th>{{ $task->curr_measure_b1 }}</th>
                            <th>{{ $task->curr_measure_b2 }}</th>
                            <th>{{ $task->curr_measure_c1 }}</th>
                            <th>{{ $task->curr_measure_c2 }}</th>
                            <th>{{ $task->curr_volume_start }}</th>
                            <th>{{ $task->curr_volume_taken }}</th>
                        <tr/>
                    @endforeach
                </tbody>

            </table>
            <br/>
        @endforeach
        <br/><hr/>
    @endforeach

@endsection
