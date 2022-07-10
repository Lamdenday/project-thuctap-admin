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
                CardName
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                CardNumber
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Total
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Phone
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Address
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                City
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                State
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                ZipCode
            </th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                Status
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach ($Orders as $Order)
            <tr>
                <td>{{ ++$stt }}</td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->cardName }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->carNumber }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->phone }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->address }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->city }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->state }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->zipCode }}</p>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{{ $Order->status }}</p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $Orders->appends(request()->all())->links() }}
</div>
