<tr>
    <th scope="row">{{ $plan->gateway_plan_id}}</th>
     <td>{{ $plan->gateway_plan_title }}</td>
     <td>{{ $plan->present()->gateway_plan_commission }}</td>
     <td>{{ $plan->present()->gateway_plan_withdrawal_rate }}</td>
     <td>{{ $plan->present()->gateway_plan_withdrawal_max }}</td>
    {{--<td>
       <a href="{{ route('admin.gateway.delete',[$gateway->gateway_id]) }}"
           class="trash-item trash-user-account">
            <i class="fas fa-trash-alt">delete</i>
        </a>
        <a href="{{ route('admin.gateway.edit',[$gateway->gateway_id]) }}"
           class="trash-item trash-user-account">
            <i class="fas fa-edit">edit</i>
        </a>
    </td>--}}
</tr>