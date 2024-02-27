<!DOCTYPE html>
<html>
<head>
    <title>PDF View</title>
    <style>
        @page {
            size: landscape;
            margin: 0;
        }
        body {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #000;
            word-wrap: break-word;
        }
        .long-text {
            white-space: normal;
            word-break: break-all;
        }
        .ref-no {
            white-space: pre-wrap;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Employee Register</h1>
    <h3>Employee name: {{$allocatedDevices[0]->employee->name}}</h3>
    <h3>Employee Code: {{$allocatedDevices[0]->employee->emp_code}}</h3>
    <table>
        <thead>
            <tr>
                <th width="3%">#</th>
                <th width="15%">Device serial no</th>
                <th width="9%">Date of Issue</th>
                <th width="15%">Date of Return</th>
                <th width="10%">Device category</th>
                <th width="9%">Item Type</th>
                <th width="15%">Oem Type</th>
            </tr>
        </thead>
        <tbody align=center>
            @foreach($allocatedDevices as $key => $allocate)
            <?php
                if ($allocate->returned_on != null) {
                    $return = $allocate->returned_on->format('d-m-Y');
                } else {
                    $return = '-';
                }
            ?>
            <tr>
                <td>{{$key + 1}}.</td> 
                <td> {{$allocate->device->serial_no}}</td>
                <td> {{$allocate->issued_on->format('d-m-Y')}}</td>
                <td> {{ $return }}</td>
                <td> {{$allocate->device->categoryRelation->category_name}}</td>
                <td> {{$allocate->device->itemType->item_name}}</td>
                <td> {{$allocate->device->oemRelation->oem_name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>