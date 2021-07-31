<?php // dd($trackerlistData['message']);?>
<div class="col-md-12">
   <div class="form-group">
      <h4 class="m-b-0 text-white" style="background: #1976d2;border-color: #1976d2">Tracker : Data </h4>
   </div>
</div>
<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Tracker : Data</h4> -->
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Policy Holder</th>
                                                <th>Tracke Id</th>
                                                <th>Rating (1-10)</th>
                                                <th>Odometer Reading (Km)</th>
                                                <th>Total Mileage (Km)</th>
                                                <th>Last Known GPS Location (Latitude, Longitude)</th>
                                                
                                                <th>Message</th>                                                
                                                <th>location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            if($trackerlistData){
                                                //dd($trackerlistData['message']);
                                                //foreach ($trackerlistData['list'] as $key => $listValue) {
                                                    //dd($listValue);
                                        ?>
                                                <tr>
                                                    <td>{{$userData['name']}}</td>
                                                    <td>{{$trackerlistData['tracker_id']}}</td>
                                                    <td></td>
                                                    <td>{{ $odometer }}</td>
                                                    <td>{{$mileageDa}}</td>
                                                    <td>{{$trackerlistData['location']['lat']}},{{$trackerlistData['location']['lng']}}</td>
                                                   
                                                    <td>{{$trackerlistData['message'] }} </td>
                                                    <td><a href="https://www.google.com/maps/dir//{{$trackerlistData['location']['lat']}},{{$trackerlistData['location']['lng']}}" target="_blank"><i class="mdi mdi-map-marker"></i> Map</a></td>
                                                </tr>
                                             
                               <?php //}   ?>
                               <?php }else{ ?>
                                            <tr><td>No record Found</td></tr>
                                   <?php  } ?>
                                        </tbody>
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php  ?>