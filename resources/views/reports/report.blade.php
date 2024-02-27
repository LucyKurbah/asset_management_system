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
    <h1>Issue of Advertisement Register</h1>
    <table >
        <thead>
            <tr>
            <th width="5%">Sl. No</th>
                <th width="9%">Date of Issue</th>
                <th width="20%">Name of Department concerned</th>
                <th width="7%">Size in cm x col</th>
                <th width="6    %">Subject</th>
                <th width="18%">Ref. No & Date</th>
                <th width="9%">Positively on</th>
                <th width="5%">No of Insertion</th>
                <th width="15%">Issued to Newspapers</th>
                <th width="10%">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($advertisements as $advertisement)
            <tr>
                <td align=center> {{ $advertisement->id }}</td>
                <td align=center> {{ $advertisement->id }}</td>
                <td> {{ $advertisement->id }}</td>
                <td align=center> {{ $advertisement->id }}</td>
                <td align=center> {{ $advertisement->id}}</td>
                <td align=center class="long-text ref-no">  </td>
                <td align=center> {{ $advertisement->id }}</td>
                <td align=center> {{ $advertisement->id }}</td>
                <td>  </td>
                <td> {{ $advertisement->id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>