<tr>
    <td scope="row">{{ $withdrawal->withdrawal_id }}</td>
    <td>{{ $withdrawal->gateway->gateway_title }}</td>
    <td>{{ $withdrawal->account->user_account_title .'/'. $withdrawal->account->owner->name }}</td>
    <td>{{ $withdrawal->present()->amount }}</td>
    <td>{{ $withdrawal->present()->commission }}</td>
    <td>{{ $withdrawal->withdrawal_ref_number }}</td>
    <td>{{ $withdrawal->present()->create }}</td>
    <td>{{ $withdrawal->present()->update }}</td>
    <td>{!!  $withdrawal->present()->adminStatus !!}</td>
    <td>
        {!!  $withdrawal->present()->adminOperations !!}
    </td>--}}
</tr>