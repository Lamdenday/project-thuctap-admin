<form id="editUserForm" data-action="{{route('users.update', $user->id)}}" method="POST" class="form-control">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="form-group">
                <strong class="form-check mb-2">Name: </strong>
                <div class="form-check input-group input-group-dynamic info-horizontal">
                    <input type="text" name="name" class="form-control" value="{{$user->name}}{{old('name')}}">
                </div>
                <div class="text-danger form-control errors error-name"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="form-group">
                <strong class="form-check mb-2">Phone: </strong>
                <div class="form-check input-group input-group-dynamic info-horizontal">
                    <input type="text" name="phone_number" class="form-control"
                           value="{{$user->phone_number}}{{old('phone_number')}}">
                </div>
                <div class="text-danger form-control errors error-phone-number"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="form-check mb-2">Email: </strong>
                <div class="form-check input-group input-group-dynamic info-horizontal">
                    <input type="email" name="email" class="form-control"
                           value="{{$user->email}}{{old('email')}}">
                </div>
                <div class="text-danger form-control errors error-email"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="form-check mb-2">Password: </strong>
                <div class="form-check input-group input-group-dynamic info-horizontal">
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="text-danger form-control errors error-password"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong class="form-check mb-2">Confirm Password: </strong>
                <div class="form-check input-group input-group-dynamic info-horizontal">
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="form-group ps-4">
                <strong style="display: inline;" class="form-check mb-2">Role: </strong>
                <select class="form-select" multiple name="roles[]">
                    @foreach($roles as $role)
                        <option @if(isset($user->userRoles))
                                @foreach($user->userRoles as $item)
                                {{$item->id == $role->id ? 'selected' :''}}
                                @endforeach
                                @endif
                                value="{{ $role->id }}">
                            {{ $role->display_name }}
                        </option>
                    @endforeach
                </select>
                <div class="text-danger form-control errors error-roles"></div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-5 mb-5 text-center">
            <button class="btn btn-primary" id="btn-edit">
                Save
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
            </button>
        </div>
    </div>
</form>

