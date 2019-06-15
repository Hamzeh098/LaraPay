<tr>
    <th scope="row">{{ $account->user_account_id}}</th>
    <td>{{ $account->owner->name }}</td>
    <td>{{ $account->user_account_title }}</td>
    <td>{{ $account->present()->accountNumber }}</td>
    <td>{{ $account->present()->shebaNumber }}</td>
    <td>{{ $account->present()->cardNumber }}</td>
    <td>
        {!! $account->present()->adminStatus !!}
    </td>
    <td>
       <a href="{{ route('admin.user.account.delete',[$account->user_account_id]) }}"
           class="trash-item trash-user-account">
            <i class="fas fa-trash-alt">delete</i>
        </a>
        <a href="{{ route('admin.user.account.edit',[$account->user_account_id]) }}"
           class="fa-trash icon-basic-trashcan-remove">
            <i class="fas fa-edit">edit</i>
        </a>
    </td>
</tr>