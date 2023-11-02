<div class="col-md-12 col-lg-4 col-xl-4">

    <div class="card card-dashboard-eight pb-2">
        <h6 class="card-title">{{__('admin.most_rated_delivery')}}<i class="fa fa-star" style="color:gold;"></i>
        </h6>

        <select wire:model="filterOption" class="form-control text-center  mx-10"
            style="width: 100px; margin-bottom:10px; float: left;">
            <option value="daily">{{ __('admin.daily') }}</option>
    
            <option value="monthly">{{ __('admin.monthly') }}</option>
            <option value="weekly">{{ __('admin.weekly') }}</option>

        </select>
        <div class="list-group">
            @foreach($deliveries as $item)
            @php
            $rating = $item->average_rating;
            @endphp
            <div class="list-group-item border-top-0">
                <p>{{$item->delivery->name}}</p><span> @for ($i = 1; $i <= 5; $i++) @if ($i <=$rating) <span
                        class="text-muted float-right">
                        <i class="fa fa-star" style="color:gold;"></i>
                </span>
                @else
                <span class="text-muted float-right">
                    <i class="fa fa-star" style="color:#ddd;"></i>
                </span>
                @endif
                @endfor</span>
            </div>
            @endforeach

        </div>
    </div>
</div>