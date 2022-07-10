@php
    $stt = (($_GET['page'] ?? 1) - 1) * 5;
@endphp
<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                style="width: 3.5rem;">No
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Name
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Email
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Role
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2"
                style="width: 10rem;">Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ ++$stt }}</td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $user->name }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $user->email }}</p>
                </td>
                <td class="align-middle">
                    @foreach($user->userRoles as $role)
                        <span
                            class="badge badge-sm bg-gradient-success">{{ $role->display_name }}</span>
                    @endforeach
                </td>
                <td class="align-middle ">
                    @isPermission('user_edit')
                    <button type="button" class="btn btn-primary btn-icon mt-3 btn-edit-user"
                            data-bs-toggle="modal"
                            data-action="{{ route('users.edit', $user->id) }}"
                            data-id="{{$user->id}}" data-bs-target="#modal-form-edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    @endisPermission

                    @isPermission('user_delete')
                    <button type="button"
                            class="btn btn-danger text-white btn-icon mt-3 btn-delete-user"
                            data-action="{{route('users.destroy', $user->id)}}"
                            data-name-show="{{$user->name}}">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endisPermission
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $users->appends(request()->all())->links() }}
</div>
