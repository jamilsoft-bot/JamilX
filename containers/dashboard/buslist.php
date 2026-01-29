
    

<div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-4 py-3">Code</th>
                    <th class="px-4 py-3">Business Name</th>
                    <th class="px-4 py-3">Plan</th>
                    <th class="px-4 py-3">Location</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Operations</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
<?php

                global $db,$Me;
                $myown = $Me->username();
                $sql = "SELECT * FROM `business` WHERE `owner`='$myown'";

                $row = $db->Query($sql);

                if($row->num_rows > 0){
                    //
                    foreach($row as $rw){
                    $data = json_decode($rw['data']);
                    $bname = isset($data->Bname)?$data->Bname:$data->name;
                    $location = isset($data->Bstreet)?$data->Bstreet:$data->street;
                    //$plan = isset($data->btype)?$data->btype:$data->type;
                    $code = $rw['code'];
                    $btype = $rw['data'];
                    $stats = $rw['status'];
                    $plan = $rw['plan'];
                    echo "<tr class='hover:bg-slate-50'>";
                    echo "<td class='px-4 py-3 font-semibold text-slate-900'>". $rw['code']."</td>";
                    echo "<td class='px-4 py-3 text-slate-700'> $bname</td>";
                    echo "<td class='px-4 py-3 text-slate-600'> $plan</td>";
                    echo "<td class='px-4 py-3 text-slate-600'> $location</td>";
                    echo "<td class='px-4 py-3'><span class='inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700'>$stats</span></td>";
                    echo "<td class='px-4 py-3'>
                            <div class='flex flex-wrap gap-2'>
                              <a href='dashboard&b=$code' class='inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700'>Manage</a>
                              <a href='upgrade&b=$code' class='inline-flex items-center rounded-lg border border-blue-200 px-3 py-1.5 text-xs font-semibold text-blue-600 hover:bg-blue-50'>Upgrade</a>
                            </div>
                          </td>";


                    }
                    
                }


?>
            </tbody>
        </table>
    </div>
    
