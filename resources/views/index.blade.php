@include("menu.head")
@switch(Auth::user()->role)
    @case("admin")
        @include("admin.$page".$sub_page = (empty($sub_page)) ? NULL : ".$sub_page")
    @break
    @case("cash")
        @include("cash.$page".$sub_page = (empty($sub_page)) ? NULL : ".$sub_page")
    @break
@endswitch
@include("menu.footer")