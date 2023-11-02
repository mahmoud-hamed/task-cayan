<div class="col-md-12 col-lg-4 col-xl-4">

    <div class="card card-dashboard-eight pb-2">
        <h6 class="card-title"> <i class="fa fa-star" style="color:gold;"></i> Most Order For {{ \Carbon\Carbon::create($year, $month)->format('F Y') }}
        </h6>

       
        <table class="table">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Total Orders</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->order_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

