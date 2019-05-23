<tr>
    <th scope="row">{{ $gateway->gateway_id}}</th>
    <td>{{ $gateway->owner->name }}</td>
    <td>{{ $gateway->gateway_title }}</td>
    <td>{{ $gateway->plan->gateway_plan_title }}</td>
    <td>{{ $gateway->gateway_balance }}</td>
    <td> {!! $gateway->present()->GatewayStatus!!}</td>
    <td>
       <a href="{{ route('admin.gateway.delete',[$gateway->gateway_id]) }}"
           class="badge badge-danger">
            <i class="fas fa-trash-alt">delete</i>
        </a>
        <a href="{{ route('admin.gateway.edit',[$gateway->gateway_id]) }}"
           class="badge badge-info">
            <i class="fas fa-edit">edit</i>
        </a>
    </td>
</tr>