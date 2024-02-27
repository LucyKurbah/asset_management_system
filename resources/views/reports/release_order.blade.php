<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11.5pt;
        }

        table {
            width: 100%;
        }

        .heading {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .line {
            margin-bottom: 10px;
        }
        .just_align {
            text-align: justify;
        }
        .font-10{
            font-size: 10pt;
        }
        .small-column {
            width: 30px; /* Adjust the width of the small column as needed */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="2" class="heading">GOVERNMENT OF MEGALAYA</td>
        </tr>
        <tr>
            <td colspan="2" class="heading">DIRECTORATE OF INFORMATION & PUBLIC RELATIONS</td>
        </tr>
        <tr><td colspan="2"><br></td></tr>
        <tr>
            <td colspan="2">Memo No. M /Advt./…………<b>{{ $advertisement->issue_date }}</b>…………………Dated Shillong the ……<b>{{ $advertisement->positively_on }}</b>....</td>
        </tr>
        <tr>
            <td colspan="2">Notification Advertisement No…<b>{{ $advertisement->ref_no}} dated {{$advertisement->ref_date}}</b>…………is forwarded to: <br><br></td>
        </tr>
        <tr>
            <td width="40%">Publisher Gazette of <br>Meghalaya, Shillong</td>
            <td class="just_align">For publication in one issue(s) of the Gazette of Meghalaya, dated.………</td>
        </tr>
        <tr>
            <td>The Advertisement <br> Manager</td>
            <td class="just_align">For publication in one issue of his paper. Bills in triplicate and quoting the Notification No. together with the voucher copy should be sent to this office for scrutiny and recommendation by the department concerned.</td>
        </tr>
        <tr>
            <td></td>
            <td class="just_align">THE TENDER NOTICE SHOULD BE PUBLISHED ATLEAST 5 (FIVE) DAYS BEFORE THE LAST DATE OF RECEIVING TENDERS BY THE DEPARTMENT CONCERNED.</td>
        </tr>
        <tr>
            <td> @foreach($advertisement->assigned_news as $assignedNews)
            <b>{{ $assignedNews->empanelled->news_name }}</b><br>
                    @endforeach</td>
            <td class="just_align ">(a) The Headlines and or headings of advertisement shall be printed in not exceeding 14 points type face size, except for display advertisement.</td>
        </tr>
        <tr>
            <td></td>
            <td class="just_align">(b) Sub-heading of an advertisement shall not exceed 12 points type face size.</td>
        </tr>
        <tr>
            <td></td>
            <td class="just_align">(c) The contents of an advertisement except the headline and/or headings sub-heading shall not exceed 12 points type face size.</td>
        </tr>
        <tr>
            <td></td>
            <td class="just_align">(d) No spacing or lead insertion can be made between the lines of the advertisement.</td>
        </tr>
        <tr>
            <td>To be published positively <br>on …<b>{{ $advertisement->positively_on}}</b>…</td>
            <td class="just_align">(e) Spacing between the 'Heading' and/or 'heading 'and the contents of an advertisement or between its paragraph(s) or between paragraph and the destination of the authority issuing the advertisement should not exceed 3-point lead.</td>
        </tr>
        <tr>
            <td></td>
            <td class="just_align">(f) The Standard width of the advertisement column should not be less than 45 millimetres.</td>
            </tr>
        <tr>
            <td></td>
            <td class="just_align">(g) The advertisement if published in a single column should not exceed centimetre or if published in double column should not exceed .............centimetre or if published in three columns should not exceed ...... centimetre or if published in four columns should not exceed ............. centimetre or if published in ………… columns should not exceed ………………. centimetres.</td>
        </tr>
        <tr>
            <td></td>
            <td class="just_align">For information with reference to his Memo No ..<b>{{ $advertisement->ref_no}} Dated {{$advertisement->ref_date}}</b>.. Bills may be addressed to the ............………………….....….…............….. </td>
            
        </tr>
        <tr>
        <td class="font-10"><i><b>{{ $advertisement->hod}}</b></i></td>
            <td>........................................................for payment.</td>
        </tr>
        <tr>
            <td></td>
            <td align="center">For Director of Information and Public Relations, Meghalaya, Shillong</td>
        </tr>
        <tr>
            <td colspan="2">Copy to the …………………………………………………………………………………………for information and necessary action with reference to …………………………....……………………………letter above.</td>
        </tr>
    </table>
</body>
</html>
