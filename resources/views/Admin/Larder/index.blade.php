<!-- Page header -->
<section class="content-header">
    <h1>{{$title}}</h1>
    <a href="{{route('larders.create')}}" class="btn btn-success">{{ __('Create') }}</a>

</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Hover rows -->
    <div class="card">
        <div class="table-responsive">
            @if($larders)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Product Term') }}</th>
                        <th>{{ __('Remember') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($larders as $larder)
                        <tr>
                            <td>{{$larder->id}}</td>
                            <td>{{$larder->product->title}}</td>
                            <td>{{$larder->product_term}}</td>
                            <td>{{$larder->remember}}</td>
                            <td>
                                <a href="{{route('larders.edit',['larder'=>$larder->id])}}"
                                   class="btn btn-primary btn-labeled">{{ __('Edit') }}
                                </a>
                                <form method="post"
                                      action="{{route('larders.delete',['larder'=>$larder->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
