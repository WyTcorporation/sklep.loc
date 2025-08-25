<!-- Page header -->
<section class="content-header">
</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
            <a href="{{route('news.create')}}" class="btn btn-success float-right">{{ __('fields.Buttons.Create') }}</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('admin.News.Title') }}</th>
                    <th>{{ __('fields.Buttons.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($news)
                    @foreach($news as $new)
                        <tr>
                            <td>{{$new->id}}</td>
                            <td>{{$new->title}}</td>
                            <td class="row">
                                <div class="">
                                    <a href="{{route('news.edit',['news'=>$new->id])}}"
                                       class="btn btn-primary btn-labeled">{{ __('fields.Buttons.Edit') }}
                                    </a>
                                </div>
                                <div class="ml-1">
                                    <form method="post" action="{{route('news.delete',['news'=>$new->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ __('fields.Buttons.Delete') }}
                                        </button>
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
                    <th>{{ __('admin.News.Title') }}</th>
                    <th>{{ __('fields.Buttons.Actions') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

</div>
<!-- /content area -->

