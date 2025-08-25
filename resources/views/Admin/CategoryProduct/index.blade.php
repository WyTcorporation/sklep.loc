<!-- Page header -->
<section class="content-header">
</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
            <a href="{{route('products.categories.create')}}"
               class="btn btn-success float-right">{{ __('fields.Buttons.Create') }}</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('fields.Title.Title') }}</th>
                    <th>{{ __('fields.Parent.Title') }}</th>
                    <th>{{ __('fields.SortOrder.Title') }}</th>
                    <th>{{ __('fields.Buttons.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($category_products)
                    @foreach($category_products as $category_product)
                        <tr>
                            <td>{{$category_product->id}}</td>
                            <td>{{$category_product->title}}</td>
                            <td>
                                {{ isset($category_product['parent'])?$category_product['parent']->title:__('fields.Categories.ParentNull') }}
                            </td>
                            <td>{{$category_product->sort_order}}</td>
                            <td class="row">
                                <div class="">
                                    <a href="{{route('products.categories.edit',['category_product'=>$category_product->id])}}"
                                       class="btn btn-primary btn-labeled">{{ __('fields.Buttons.Edit') }}
                                    </a>
                                </div>
                                <div class="ml-1">
                                    <form method="post" action="{{route('products.categories.delete',['category_product'=>$category_product->id])}}">
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
                    <th>{{ __('fields.Parent.Title') }}</th>
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
