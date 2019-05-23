<tr>
    <td scope="row">{{ $report->gateway_report_id }}</td>
    <td>{{ $report->present()->name }}</td>
    <td>{{ $report->present()->date }}</td>
    <td>{{ $report->present()->deposit }}</td>
    <td>{{ $report->present()->withdrawal }}</td>
</tr>