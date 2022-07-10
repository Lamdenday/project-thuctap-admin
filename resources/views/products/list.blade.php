@php
    $stt = (($_GET['page'] ?? 1) - 1) * 5;
@endphp

<div class="table-responsive">
    <table class="table table-hover align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2"
                style="width: 3.5rem;">No
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Name
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Image
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Category
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Price
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2" style="width: 10rem;">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $key => $product)
            <tr>
                <td class="text-center">{{ ++$stt }}</td>
                <td>
                    <p class="text-xl font-weight-bold mb-0">{{ $product->title }}</p>
                </td>

                <td>
                    <a href="{{$product->image_url;}}" target="_blank">
                        <img src="{{asset('product_images/'.$product->image_url)}}" width="100">
                    </a>
                </td>
                <td>
                    <p class="text-xl font-weight-bold mb-0">{{ $product->categoryProduct->title??'' }}</p>
                </td>
                <td>
                    <p class="text-xl font-weight-bold mb-0">{{ number_format($product->price) }}</p>
                </td>
                <td class="align-middle">
                    @isPermission('product_edit')
                    <button type="button"
                            class="btn btn-primary btn-icon mt-3 btn-edit-product"
                            data-bs-toggle="modal"
                            data-action="{{route('products.show',$product->id)}}"
                            data-bs-target="#modal-form-edit">
                        <i class="fas fa-edit fa-lg"></i>
                    </button>
                    @endisPermission
                    @isPermission('product_delete')
                    <button type="button"
                            class="btn btn-danger btn-icon mt-3 btn-delete-product"
                            data-action="{{route('products.destroy',$product->id)}}"
                            data-name-show="{{$product->name}}">
                        <i class="fas fa-trash fa-lg"></i>
                    </button>
                    @endisPermission
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $products->appends(request()->all())->links() }}
</div>
