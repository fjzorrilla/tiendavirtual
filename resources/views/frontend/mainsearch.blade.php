<section class="header shop sectionsearch">
    <div class="search-bar-top">
        <form method="POST" action="{{route('product.search')}}">
        @csrf        
            <div class="search-bar">
                @php
                    $menu=App\Models\Category::getAllParentWithChild();
                @endphp
                <select name="search" onchange="$('.catId').val(this.value)">
                    <option value="0">Todas las Categorias</option>

                    @foreach($menu as $cat)
                        <option value="{{$cat->slug}}">{{$cat->title}}</option>
                        @foreach($cat->child_cat as $sub_menu) 
                            <option value="{{$sub_menu->slug}}">{{$cat->title}} - {{$sub_menu->title}}</option>
                            @php
                                $submenu=App\Models\Category::getChildByParentIDMain($sub_menu->id);
                            @endphp
                            @foreach($submenu as $sub_menus)
                                <option value="{{$sub_menus->slug}}">{{$cat->title}} - {{$sub_menu->title}} - {{$sub_menus->title}}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
                    <input name="cat" class="catId" type="hidden" value="0">
                    <input name="search" placeholder="Buscar Productos aquí....." type="search">
                    <button class="btnn" type="submit"><i class="ti-search"></i></button>
                
            </div>
        </form>
    </div>
</section>