@foreach($items as $item)
    <li @if($item->hasChildren())class=" parent-item " @endif>
        <a href="{{$item->url()}}">
            {{$item->title}}
        </a>
        @if($item->hasChildren())
            <ul class="header__dropdown">
                @include('Pub::layouts.menuItems',['items'=>$item->children()])
            </ul>
        @endif
    </li>
@endforeach
