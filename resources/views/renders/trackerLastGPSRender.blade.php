<?php
// dd($getReadingsData);
if (!empty($lastGpsPointData)) {
    ?>
<div class="col-md-12">
   <div class="form-group">
      <h4 class="m-b-0 text-white" style="background: #1976d2;border-color: #1976d2">Tracker : Last GPS Point </h4>
   </div>
</div>
<div class="col-md-12">
   <div class="form-group">
      <div class="demo-checkbox">
            <label>lat</label>{{$lastGpsPointData['lat']}}<br>
            <label>lng</label>{{$lastGpsPointData['lng']}}<br>
            <label>address</label>{{$lastGpsPointData['address']}}<br>
            <label>satellites</label>{{$lastGpsPointData['satellites']}}<br>
            <label>get_time</label>{{$lastGpsPointData['get_time']}}<br>
            <label>mileage</label>{{$lastGpsPointData['mileage']}}<br>
            <label>heading</label>{{$lastGpsPointData['heading']}}<br>
            <label>speed</label>{{$lastGpsPointData['speed']}}<br>
            <label>alt</label>{{$lastGpsPointData['alt']}}<br>
            <div class="btn_navigate">
               <a href="https://www.google.com/maps/dir//{{$lastGpsPointData['lat']}},{{$lastGpsPointData['lng']}}" target="_blank">Go to Maps</a>
            </div>
      </div>
   </div>
</div>
<?php
} else {
    echo "No lastGpsPointData Data";

}
if (!empty($getStateData)) {?>



<div class="col-md-12">
   <div class="form-group">
      <h4 class="m-b-0 text-white" style="background: #1976d2;border-color: #1976d2">Tracker : Get State </h4>
   </div>
</div>
<div class="col-md-12">
   <div class="form-group">
      <div class="demo-checkbox">
            <label>source_id</label>{{$getStateData['source_id']}}<br>
            <label>updated</label>{{$getStateData['gps']['updated']}}<br>
            <label>signal_level</label>{{$getStateData['gps']['signal_level']}}<br>
            <label>lat</label>{{$getStateData['gps']['location']['lat']}}<br>
            <label>lng</label>{{$getStateData['gps']['location']['lng']}}<br>
            <label>heading</label>{{$getStateData['gps']['heading']}}<br>
            <label>speed</label>{{$getStateData['gps']['speed']}}<br>
            <label>precision</label>{{$getStateData['gps']['precision']}}<br>
            <label>alt</label>{{$getStateData['gps']['alt']}}<br>

            <label>connection_status</label>{{$getStateData['connection_status']}}<br>
            <label>movement_status</label>{{$getStateData['movement_status']}}<br>
            <label>battery_level</label>{{$getStateData['battery_level']}}<br>
        </div>
   </div>
</div>
<?php } else {
    echo "No getState Data";
}?>