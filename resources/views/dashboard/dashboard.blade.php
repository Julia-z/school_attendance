@extends('layouts.dashboard')

@section('pg')


@if(Auth::user()->school_id != null)
<div class="col-md-12">
  <h1 class="title-bar-title">Today's Attendance For School 1</h1>

<div class="col-md-4">
   <div class="card" id="top2">
     <div class="card-body">
       <div class="media">
         <div class="media-middle media-left">
           <div class="media-chart">
             <canvas data-chart="doughnut" data-animation="false" data-labels='["Total Students", "Late Students", "Absent Students"]'
               data-values='[{"backgroundColor": ["#555", "blue", "red"], "data": [ 800, 50, 35 ]}]'
               data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
           </div>
         </div>
         <div class="media-middle media-body">
           <h2 class="media-heading">
           </h2>
                         <span style="font-size: 150%;">
               1000 Total <br/>
              <span style="color:blue;">50 </span>Late -
               <span style="color:red;">36 </span>Absent
           </span>
                       </div>
       </div>
     </div>
   </div>
 </div>
 <div class="col-md-4">
    <div class="card" id="top2">
      <div class="card-body">
        <div class="media">
          <div class="media-middle media-left">
            <div class="media-chart">
              <canvas data-chart="doughnut" data-animation="false" data-labels='["Total Absences", "Messages Sent"]'
                data-values='[{"backgroundColor": ["#555", "blue"], "data": [ 6, 30]}]'
                data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
            </div>
          </div>
          <div class="media-middle media-body">
            <h2 class="media-heading">
            </h2>
                          <span style="font-size: 150%;">
                36 Absences <br/>
               <span style="color:blue;">30  </span>messages sent <br/>
            </span>
                        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
     <div class="card" id="top2">
       <div class="card-body">
         <div class="media">
           <div class="media-middle media-left">
             <div class="media-chart">
               <canvas data-chart="doughnut" data-animation="false" data-labels='["Absent Students", "Medically excused Students"]'
                 data-values='[{"backgroundColor": ["#555", "blue"], "data": [ 36, 10 ]}]'
                 data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
             </div>
           </div>
           <div class="media-middle media-body">
             <h2 class="media-heading">
             </h2>
                           <span style="font-size: 150%;">
                 36 Absent <br/>
                 <span style="color:blue;">10 </span>Medically excused
             </span>
          </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <div class="col-md-12">
   <div class="col-md-6">
     <div class="panel panel-body" data-toggle="match-height">
       <h6 class="text-center m-t-0">Absences Distribution per class (23 absences)</h6>
       <div class="row">
         <div class="col-md-3">
           <ul class="list-unstyled">
             <li class="m-b">
               <small class="nowrap">
                 <span class="icon icon-square icon-fw" style="color: #80bf41"></span>
                 Grade 1
               </small>
             </li>
             <li class="m-b">
               <small class="nowrap">
                 <span class="icon icon-square icon-fw" style="color: #f2d548"></span>
                 Grade 2
               </small>
             </li>
             <li class="m-b">
               <small class="nowrap">
                 <span class="icon icon-square icon-fw" style="color: #0359a5"></span>
                 Grade 3
               </small>
             </li>
             <li class="m-b">
               <small class="nowrap">
                 <span class="icon icon-square icon-fw" style="color: #e86203"></span>
                 Grade 4
               </small>
             </li>
             <li class="m-b">
               <small class="nowrap">
                 <span class="icon icon-square icon-fw" style="color: #d9184b"></span>
                 Grade 5
               </small>
             </li>
             <li class="m-b">
               <small class="nowrap">
                 <span class="icon icon-square icon-fw" style="color: #ededed"></span>
                 Grade 6
               </small>
             </li>
           </ul>
         </div>
         <div class="col-md-6">
           <iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
 <canvas data-chart="pie" data-labels="[&quot;Total: 30, Absences:&quot;, &quot;Total: 35, Absences&quot;, &quot;Total: 42, Absences&quot;, &quot;Total: 28, Absences&quot;, &quot;Total: 27, Absences&quot;, &quot;Total: 35, Absences&quot;]" data-values="[{&quot;backgroundColor&quot;: [&quot;#80bf41&quot;, &quot;#f2d548&quot;, &quot;#0359a5&quot;, &quot;#e86203&quot;, &quot;#d9184b&quot;, &quot;#ededed&quot;], &quot;data&quot;: [3, 4, 1, 2, 10, 3]}]" data-hide="[&quot;scalesX&quot;, &quot;scalesY&quot;, &quot;legend&quot;]" height="242" width="242" style="display: block; width: 242px; height: 242px;"></canvas>
         </div>
       </div>
     </div>
   </div>

     <div class="col-md-6">
       <div class="panel panel-body" data-toggle="match-height">
         <h6 class="text-center m-t-0">Late Students Distribution per class (33 late)</h6>
         <div class="row">
           <div class="col-md-3">
             <ul class="list-unstyled">
               <li class="m-b">
                 <small class="nowrap">
                   <span class="icon icon-square icon-fw" style="color: #80bf41"></span>
                   Grade 1
                 </small>
               </li>
               <li class="m-b">
                 <small class="nowrap">
                   <span class="icon icon-square icon-fw" style="color: #f2d548"></span>
                   Grade 2
                 </small>
               </li>
               <li class="m-b">
                 <small class="nowrap">
                   <span class="icon icon-square icon-fw" style="color: #0359a5"></span>
                   Grade 3
                 </small>
               </li>
               <li class="m-b">
                 <small class="nowrap">
                   <span class="icon icon-square icon-fw" style="color: #e86203"></span>
                   Grade 4
                 </small>
               </li>
               <li class="m-b">
                 <small class="nowrap">
                   <span class="icon icon-square icon-fw" style="color: #d9184b"></span>
                   Grade 5
                 </small>
               </li>
               <li class="m-b">
                 <small class="nowrap">
                   <span class="icon icon-square icon-fw" style="color: #ededed"></span>
                   Grade 6
                 </small>
               </li>
             </ul>
           </div>
           <div class="col-md-6">
             <iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
   <canvas data-chart="pie" data-labels="[&quot;Total: 30, late:&quot;, &quot;Total: 35, late&quot;, &quot;Total: 42, late&quot;, &quot;Total: 28, late&quot;, &quot;Total: 27, late&quot;, &quot;Total: 35, late&quot;]" data-values="[{&quot;backgroundColor&quot;: [&quot;#80bf41&quot;, &quot;#f2d548&quot;, &quot;#0359a5&quot;, &quot;#e86203&quot;, &quot;#d9184b&quot;, &quot;#ededed&quot;], &quot;data&quot;: [5, 9, 1, 4, 5, 9]}]" data-hide="[&quot;scalesX&quot;, &quot;scalesY&quot;, &quot;legend&quot;]" height="242" width="242" style="display: block; width: 242px; height: 242px;"></canvas>
           </div>
         </div>
       </div>
     </div>
 </div>
 </div>

     <div class="col-md-12">

     <!-- <h1 class="title-bar-title">Attendance Reports</h1> -->

  <div class="col-md-6">
    <div class="row gutter-xs">
      <div class="col-md-12">
        <h4 class="card-title">Weekly Attendance Report (%)</h4>
        <div class="card">
          <div class="card-body">
          </div>
          <div class="card-body">

            <div class="card-chart">
              <canvas data-chart="bar" data-animation="false" data-labels='["Sun", "Mon", "Tue - Holiday", "Wed", "Thu"]'
              data-values='[{"label": "Attendance", "backgroundColor": "#0288d1", "borderColor": "#0288d1", "data": [80, 95, 0, 70]}]'data-hide='["gridLinesX", "legend"]' data-tooltips='{"mode": "label"}' height="113"></canvas>
              <h6 class="m-b-0" style="text-align:center;">Attendance percentage per day</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row gutter-xs">
      <div class="col-md-12">
        <h4 class="card-title">Monthly Absence Report (%)</h4>
        <div class="card">
          <div class="card-body">
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="bar" data-animation="false" data-labels='["Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "March", "Apr", "May", "June"]'
               data-values='[{"label": "Absences", "backgroundColor": "red", "borderColor": "red",  "data": [12, 15, 20, 22, 18, 19, 15]}]'
               data-hide='["gridLinesX", "legend"]' data-tooltips='{"mode": "label"}' height="113"></canvas>
               <h6 class="m-b-0" style="text-align:center;">Percentage of absent students per month</h6>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- <div class="col-md-6">
    <div class="row gutter-xs">
      <div class="col-md-12">
        <h4 class="card-title">Absent Students By class</h4>
        <select class="form-control">
          <option>-- School --</option>
          <option>School 1</option>
          <option>School 2</option>
        </select><br/>
        <select class="form-control">
          <option>-- Class --</option>
          <option>Grade 1- section 1 </option>
          <option>Grade 2- section 1 </option>
          <option>Grade 2- section 2 </option>
          <option>Grade 1- section 1 </option>
          <option>Grade 1- section 1 </option>
          <option>Grade 1- section 1 </option>
        </select>
        <br/>
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
            </div>
             Absent Students <span id="user_list_id"></span>
          </div>
          <div class="card-body" data-toggle="match-height" >
          <table class="table table-borderless table-middle">
            <tbody>
              <tr>
                  <td class="col-xs-6"> Student 1</td>
                  <td class="col-xs-6"> (1 absence this month)</td>
              </tr>
              <tr>
                  <td class="col-xs-6"> Student 2</td>
                  <td class="col-xs-6"> (0 absence this month)</td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
     </div>
  </div> -->
<div class="col-md-12">
  <div class="col-xs-12">
   <!-- <h1 class="title-bar-title">Absence Details</h1> -->

      <div class="card">
        <div class="card-header">
          <div class="card-actions">
            <button type="button" class="card-action card-toggler" title="Collapse"></button>
            <button type="button" class="card-action card-reload" title="Reload"></button>
            <button type="button" class="card-action card-remove" title="Remove"></button>
          </div>
          <strong>Absent Students</strong>
        </div>
        <div class="card-body">
          <table id="demo-datatables-4" data-length-menu='[[5, 10, 25, 50, 100, -1], ["5", "10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Medical Condition</th>
                <th>Number of total absences this month</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Medical Condition</th>
                <th>Number of total absences this month</th>
              </tr>
            </tfoot>
            <tbody>
              <tr>
                <td>Student 1</td>
                <td>Grade 1</td>
                <td></td>
                <td>2</td>
              </tr>
              <tr>
                <td>Student 2</td>
                <td>Grade 1</td>
                <td>Diabetes</td>
                <td>0</td>
              </tr>
              <tr>
                <td>Student 3</td>
                <td>Grade 2</td>
                <td>Diabetes</td>
                <td>7</td>
              </tr>
              <tr>
                <td>Student 4</td>
                <td>Grade 5</td>
                <td>Epilepsy</td>
                <td>2</td>
              </tr>
              <tr>
                <td>Student 6</td>
                <td>Grade 5</td>
                <td>-</td>
                <td>0</td>
              </tr>
              <tr>
                <td>Student 7</td>
                <td>Grade 5</td>
                <td>-</td>
                <td>12</td>
              </tr>

              <tr>
                <td>Student 8</td>
                <td>Grade 7</td>
                <td>-</td>
                <td>8</td>
              </tr>
              <tr>
                <td>Student 9</td>
                <td>Grade 6</td>
                <td>-</td>
                <td>2</td>
              </tr>


            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
  @else
<!-- <div class="col-md-12">
  <h1 class="title-bar-title">Today's Attendance</h1>
  <div class="col-md-4">
     <div class="card" id="top2">
       <div class="card-body">
         <div class="media">
           <div class="media-middle media-left">
             <div class="media-chart">
               <canvas data-chart="doughnut" data-animation="false" data-labels='["Total Students", "Late Students", "Absent Students"]'
                 data-values='[{"backgroundColor": ["#555", "blue", "red"], "data": [ 1200, 59, 26 ]}]'
                 data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
             </div>
           </div>
           <div class="media-middle media-body">
             <h2 class="media-heading">
               <small><span  class="top-of-summary">School 1</span></small>
             </h2>
                           <span style="font-size: 150%;">
                 1200 Total <br/>
                <span style="color:blue;">59 </span>Late -
                 <span style="color:red;">26 </span>Absent
             </span>
                         </div>
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="card" id="top2">
        <div class="card-body">
          <div class="media">
            <div class="media-middle media-left">
              <div class="media-chart">
                <canvas data-chart="doughnut" data-animation="false" data-labels='["Total Students", "Late Students", "Absent Students"]'
                  data-values='[{"backgroundColor": ["#555", "blue", "red"], "data": [ 1200, 60, 15 ]}]'
                  data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
              </div>
            </div>
            <div class="media-middle media-body">
              <h2 class="media-heading">
                <small><span  class="top-of-summary">School 2</span></small>
              </h2>
                            <span style="font-size: 150%;">
                  1502 Total <br/>
                 <span style="color:blue;">60 </span>Late -
                  <span style="color:red;">16 </span>Absent
              </span>
                          </div>
          </div>
        </div>
      </div>
    </div>
  <div class="col-md-4">
     <div class="card" id="top2">
       <div class="card-body">
         <div class="media">
           <div class="media-middle media-left">
             <div class="media-chart">
               <canvas data-chart="doughnut" data-animation="false" data-labels='["Total Students", "Late Students", "Absent Students"]'
                 data-values='[{"backgroundColor": ["#555", "blue", "red"], "data": [ 800, 50, 35 ]}]'
                 data-hide='["legend", "scalesX", "scalesY", "tooltips"]' height="64" width="64"></canvas>
             </div>
           </div>
           <div class="media-middle media-body">
             <h2 class="media-heading">
               <small><span  class="top-of-summary">School 3</span></small>
             </h2>
                           <span style="font-size: 150%;">
                 1000 Total <br/>
                <span style="color:blue;">50 </span>Late -
                 <span style="color:red;">36 </span>Absent
             </span>
                         </div>
         </div>
       </div>
     </div>
   </div>
</div> -->
<div class="col-md-12">
  <div class="col-md-6">
    <div class="panel panel-body" data-toggle="match-height">
      <h6 class="text-center m-t-0">Absences distribution per school (271 absences)</h6>
      <div class="row">
        <div class="col-md-3">
          <ul class="list-unstyled">
            <li class="m-b">
              <small class="nowrap">
                <span class="icon icon-square icon-fw" style="color: #80bf41"></span>
                School 1
              </small>
            </li>
            <li class="m-b">
              <small class="nowrap">
                <span class="icon icon-square icon-fw" style="color: #f2d548"></span>
                School 2
              </small>
            </li>
            <li class="m-b">
              <small class="nowrap">
                <span class="icon icon-square icon-fw" style="color: #0359a5"></span>
                School 3
              </small>
            </li>
            <li class="m-b">
              <small class="nowrap">
                <span class="icon icon-square icon-fw" style="color: #e86203"></span>
                School 4
              </small>
            </li>
            <li class="m-b">
              <small class="nowrap">
                <span class="icon icon-square icon-fw" style="color: #d9184b"></span>
                School 5
              </small>
            </li>

          </ul>
        </div>
        <div class="col-md-6">
          <iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
<canvas data-chart="pie" data-labels="[&quot;Total: 3330, absent:&quot;, &quot;Total: 3501, absent&quot;, &quot;Total: 420, absent&quot;, &quot;Total: 2853, absent&quot;, &quot;Total: 2701, absent&quot;, &quot;Total: 3500, absent&quot;]" data-values="[{&quot;backgroundColor&quot;: [&quot;#80bf41&quot;, &quot;#f2d548&quot;, &quot;#0359a5&quot;, &quot;#e86203&quot;, &quot;#d9184b&quot;, &quot;#ededed&quot;], &quot;data&quot;: [30, 40, 19, 23, 120, 39]}]" data-hide="[&quot;scalesX&quot;, &quot;scalesY&quot;, &quot;legend&quot;]" height="242" width="242" style="display: block; width: 242px; height: 242px;"></canvas>
        </div>
      </div>
    </div>
  </div>

    <div class="col-md-6">
      <div class="panel panel-body" data-toggle="match-height">
        <h6 class="text-center m-t-0">Late students distribution per school (448 late)</h6>
        <div class="row">
          <div class="col-md-3">
            <ul class="list-unstyled">
              <li class="m-b">
                <small class="nowrap">
                  <span class="icon icon-square icon-fw" style="color: #80bf41"></span>
                  School 1
                </small>
              </li>
              <li class="m-b">
                <small class="nowrap">
                  <span class="icon icon-square icon-fw" style="color: #f2d548"></span>
                  School 2
                </small>
              </li>
              <li class="m-b">
                <small class="nowrap">
                  <span class="icon icon-square icon-fw" style="color: #0359a5"></span>
                  School 3
                </small>
              </li>
              <li class="m-b">
                <small class="nowrap">
                  <span class="icon icon-square icon-fw" style="color: #e86203"></span>
                  School 4
                </small>
              </li>
              <li class="m-b">
                <small class="nowrap">
                  <span class="icon icon-square icon-fw" style="color: #d9184b"></span>
                  School 5
                </small>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
  <canvas data-chart="pie" data-labels="[&quot;Total: 3330, late:&quot;, &quot;Total: 3501, late&quot;, &quot;Total: 420, late&quot;, &quot;Total: 2853, late&quot;, &quot;Total: 2701, late&quot;, &quot;Total: 3500, late&quot;]" data-values="[{&quot;backgroundColor&quot;: [&quot;#80bf41&quot;, &quot;#f2d548&quot;, &quot;#0359a5&quot;, &quot;#e86203&quot;, &quot;#d9184b&quot;, &quot;#ededed&quot;], &quot;data&quot;: [50, 93, 102, 45, 59, 99 ]}]" data-hide="[&quot;scalesX&quot;, &quot;scalesY&quot;, &quot;legend&quot;]" height="242" width="242" style="display: block; width: 242px; height: 242px;"></canvas>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="col-md-12">
  <div class="col-md-12">

     <div class="card">
       <div class="card-header">
         <div class="card-actions">
           <button type="button" class="card-action card-toggler" title="Collapse"></button>
           <button type="button" class="card-action card-reload" title="Reload"></button>
           <button type="button" class="card-action card-remove" title="Remove"></button>
         </div>
         <strong>Absent Students</strong>
       </div>
       <div class="card-body">
         <table id="demo-datatables-4" data-length-menu='[[5, 10, 25, 50, 100, -1], ["5", "10", "25", "50", "100", "All"]]' class="table table-striped table-nowrap dataTable" cellspacing="0" width="100%">
           <thead>
             <tr>
               <th>Name</th>
               <th>School</th>
               <th>Class</th>
               <th>Medical Condition</th>
               <th>Cumulative Absences this month</th>
             </tr>
           </thead>
           <tfoot>
             <tr>
               <th>Name</th>
               <th>School</th>
               <th>Class</th>
               <th>Medical Condition</th>
               <th>Cumulative absences this month</th>
             </tr>
           </tfoot>
           <tbody>
             <tr>
               <td>Student 1</td>
               <td>School 1</td>
               <td>Grade 1</td>
               <td></td>
               <td>2</td>
             </tr>
             <tr>
               <td>Student 2</td>
               <td>School 1</td>
               <td>Grade 1</td>
               <td>Diabetes</td>
               <td>0</td>
             </tr>
             <tr>
               <td>Student 3</td>
               <td>School 1</td>
               <td>Grade 2</td>
               <td>Diabetes</td>
               <td>7</td>
             </tr>
             <tr>
               <td>Student 4</td>
               <td>School 2</td>
               <td>Grade 5</td>
               <td>Epilepsy</td>
               <td>2</td>
             </tr>
             <td>Student 5</td>
             <td>School 1</td>
             <td>Grade 5</td>
             <td>-</td>
             <td>2</td>
           </tr>
           <td>Student 6</td>
           <td>School 2</td>
           <td>Grade6</td>
           <td>-</td>
           <td>2</td>
         </tr>
         <td>Student 7</td>
         <td>School 2</td>
         <td>Grade 2</td>
         <td>-</td>
         <td>12</td>
       </tr>
       <td>Student 8</td>
       <td>School 3</td>
       <td>Grade 9</td>
       <td>-</td>
       <td>9</td>
     </tr>
     <td>Student 9</td>
     <td>School 3</td>
     <td>Grade 8</td>
     <td>-</td>
     <td>20</td>
   </tr>

           </tbody>
         </table>
       </div>
     </div>
   </div>
</div>
<div class="col-md-12">

  <div class="col-md-12">
    <div class="row gutter-xs">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Weekly Attendance Report(%)</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="bar" data-animation="false" data-labels='["Sun", "Mon", "Tue - Holiday", "Wed", "Thu"]' data-values='[{"label": "Absences -School 1",
              "backgroundColor": "#0288d1", "borderColor": "#0288d1", "data": [80, 95, 0, 60]}, {"label": "Absences -School 3", "backgroundColor": "green",
               "borderColor": "green", "data": [60, 80, 0, 98]}, {"label": "Absences - School 2", "backgroundColor": "#d50000", "borderColor": "#d50000",
                "data": [80, 85, 0, 85]}]' data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="113"></canvas>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="row gutter-xs">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Monthly Absence Report (%)</h4>
          </div>
          <div class="card-body">
            <div class="card-chart">
              <canvas data-chart="bar" data-animation="false" data-labels='["Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "March", "Apr", "May", "June"]'
               data-values='[{"label": "Absences - School 1", "backgroundColor": "#0288d1", "borderColor": "#0288d1", "data": [25, 18, 13, 20, 11]},
               {"label": "Absences - School 3 ", "backgroundColor": "green", "borderColor": "green", "data": [20, 25, 18, 19, 16]},
               {"label": "Absences - School 2", "backgroundColor": "#d50000", "borderColor": "#d50000", "data": [18, 17, 22, 19, 13]}]'
               data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend"]' height="113"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- <div class="col-md-6">
    <div class="row gutter-xs">
      <div class="col-md-12">
        <h4 class="card-title">Absent Students By class</h4>
        <select class="form-control">
          <option>-- School --</option>
          <option>School 1</option>
          <option>School 2</option>
        </select><br/>
        <select class="form-control">
          <option>-- Class --</option>
          <option>Grade 1- section 1 </option>
          <option>Grade 2- section 1 </option>
          <option>Grade 2- section 2 </option>
          <option>Grade 1- section 1 </option>
          <option>Grade 1- section 1 </option>
          <option>Grade 1- section 1 </option>
        </select>
        <br/>
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
            </div>
             Absent Students <span id="user_list_id"></span>
          </div>
          <div class="card-body" data-toggle="match-height" >
          <table class="table table-borderless table-middle">
            <tbody>
              <tr>
                  <td class="col-xs-6"> Student 1</td>
                  <td class="col-xs-6"> (1 absence this month)</td>
              </tr>
              <tr>
                  <td class="col-xs-6"> Student 2</td>
                  <td class="col-xs-6"> (0 absence this month)</td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
     </div>
  </div>
 -->

  @endif
  @endsection
  @section('scripts')

  </script>')
  <script>
  $(document).ready(
    function () {
      var canvas = document.getElementById("dist_chart");
      var ctx = canvas.getContext("2d");
      Chart.defaults.global.legend.display = false;
      var myNewChart = new Chart(ctx, {
        type: 'pie',
        data: data
      });
    });
  </script>
    @endsection
