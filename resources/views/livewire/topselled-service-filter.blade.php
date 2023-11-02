<div class="col-md-12 col-lg-4 col-xl-4">

    <div class="card card-dashboard-eight pb-2">
        <h6 class="card-title">{{ __('admin.most_selled_service') }}<i class="fa fa-star" style="color:gold;"></i>
        </h6>

        <select wire:model="filterOption" class="form-control text-center  mx-10"
            style="width: 100px; margin-bottom:10px; float: left;">
            <option value="daily">{{ __('admin.daily') }}</option>

            <option value="monthly">{{ __('admin.monthly') }}</option>
            <option value="weekly">{{ __('admin.weekly') }}</option>

        </select>
        <div class="list-group">
        <table class="table text-center">
    <thead>
        <tr>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.Order_revenue')}}</th>
            <th>{{__('admin.order_count')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->total_del_price_sum}}</td>
            <td>{{$item->total_sold}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
</div>
