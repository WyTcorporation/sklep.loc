<!-- Page header -->
<section class="content-header">
</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
            <a href="{{route('orders.create')}}"
               class="btn btn-success float-right">{{ __('fields.Buttons.Create') }}</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('fields.Delivery.Title') }}</th>
                    <th>{{ __('fields.Payment.Title') }}</th>
                    <th>{{ __('fields.NP.Title') }}</th>
                    <th>{{ __('fields.Fio.Title') }}</th>
                    <th>{{ __('fields.Phone.Title') }}</th>
                    <th>{{ __('fields.Status.Title') }}</th>
                    <th>{{ __('fields.Total.Title') }}</th>
                    <th>{{ __('fields.Buttons.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($orders)
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <th>
                                {{$deliveryList[$order->delivery]}}
                            </th>
                            <th>{{$paymentList[$order->payment]}}</th>
                            <th>
                                {{$order->np_warehouses}}
                            </th>
                            <th>{{$order->fio}}</th>
                            <th>{{$order->phone}}</th>
                            <th>
                                <span @switch($order->status->value)
                                          @case('1')
                                              class="text-warning"
                                      @break

                                      @case('2')
                                          class="text-success"
                                      @break

                                      @default
                                          class="text-danger"
                                @endswitch>
                                    {{$statusList[$order->status->value]}}
                                </span>
                            </th>
                            <th>{{$order->total}}</th>
                            <td class="row">
                                <div class="">
                                    <a href="{{route('orders.edit',['order'=>$order->id])}}"
                                       class="btn btn-primary btn-labeled">{{ __('fields.Buttons.Edit') }}
                                    </a>
                                </div>
                                <div class="ml-1">
                                    <form method="post" action="{{route('orders.delete',['order'=>$order->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger">{{ __('fields.Buttons.Delete') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('fields.Delivery.Title') }}</th>
                    <th>{{ __('fields.Payment.Title') }}</th>
                    <th>{{ __('fields.NP.Title') }}</th>
                    <th>{{ __('fields.Fio.Title') }}</th>
                    <th>{{ __('fields.Phone.Title') }}</th>
                    <th>{{ __('fields.Status.Title') }}</th>
                    <th>{{ __('fields.Total.Title') }}</th>
                    <th>{{ __('fields.Buttons.Actions') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

</div>
<!-- /content area -->

