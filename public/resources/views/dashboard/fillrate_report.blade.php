<style>
th, td {
    padding: 5px;
    text-align: left;
    }
thead th, thead td {
    text-align: center;;
}
</style>

<table border="1" style="border-collapse: collapse;">

    <thead>
        <tr>
            <td> Tank </td>
            <td> Entries </td>
            <td> Fill rate (m<sup>3</sup>/hour) </td>
            <td> Standard Deviation </td>
            <td> STD as percentage</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($tank_data as $tank)
                <tr>
                    <td>{{$tank->nb}}</td>
                    <td>{{$tank->count}}</td>
                    <td>{{$tank->fr}}</td>
                    <td>{{$tank->std}}</td>
                    <td>{{ number_format(100*$tank->std/($tank->fr + 0.0), 2) }}%</td>
                </tr>

            @endforeach
        </tr>
    </tbody>
