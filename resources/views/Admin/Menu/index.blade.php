<!-- Page header -->
<section class="content-header">
</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
            <a href="{{route('menus.create')}}"
               class="btn btn-success float-right">{{ __('fields.Buttons.Create') }}</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('fields.Title.Title') }}</th>
                    <th>{{ __('fields.Alias.Title') }}</th>
                    <th>{{ __('fields.Parent.Title') }}</th>
                    <th>{{ __('fields.Type.Title') }}</th>
                    <th>{{ __('fields.SortOrder.Title') }}</th>
                    <th>{{ __('fields.Buttons.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($menus)
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{$menu->id}}</td>
                            <td> {{$menu->title}}</td>
                            <td> {{$menu->path}}</td>
                            <td>{{$menu->parent}}</td>
                            <td>{{$menu->type}}</td>
                            <td>{{$menu->sort_order}}</td>
                            <td class="row">
                                <div class="">
                                    <a href="{{route('menus.edit',['menu'=>$menu->id])}}"
                                       class="btn btn-primary btn-labeled">{{ __('fields.Buttons.Edit') }}
                                    </a>
                                </div>
                                <div class="ml-1">
                                    <form method="post" action="{{route('menus.delete',['menu'=>$menu->id])}}">
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
                    <th>{{ __('fields.Title.Title') }}</th>
                    <th>{{ __('fields.Alias.Title') }}</th>
                    <th>{{ __('fields.Parent.Title') }}</th>
                    <th>{{ __('fields.Type.Title') }}</th>
                    <th>{{ __('fields.SortOrder.Title') }}</th>
                    <th>{{ __('fields.Buttons.Actions') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

</div>
<!-- /content area -->
