@php
    $stt = (($_GET['page'] ?? 1) - 1) * 5;
@endphp
<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2"
                style="width: 3.5rem;">No
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Name
            </th>

            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Name Parent
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2" style="width: 10rem;">
                Action
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categoriesPaginate as $category)
            <tr>
                <td class="text-center">{{ ++$stt }}</td>
                <td>
                    <p class="text-xl font-weight-bold mb-0">{{ $category->title }}</p>
                </td>
                <td class="align-middle">
                    @isPermission('category_edit')
                    <button type="button" class="btn btn-primary btn-outline-primary btn-icon mt-3 btn-edit-cate"
                            data-bs-toggle="modal"
                            data-action="{{route('categories.show', $category->id)}}"
                            data-id="{{$category->id}}" data-bs-target="#modal-form-edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    @endisPermission
                    @isPermission('category_delete')
                    <button type="button" class="btn btn-danger btn-outline-danger btn-icon mt-3 btn-delete-cate"
                            data-action="{{route('categories.destroy', $category->id)}}"
                            data-name-show="{{$category->name}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @endisPermission
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $categoriesPaginate->appends(request()->all())->links() }}
</div>
