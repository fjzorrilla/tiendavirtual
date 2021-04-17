<section class="header shop sectionsearch">
    <div class="search-bar-top">
        <div class="search-bar">
            <select>
                <option >Todas las Categorias</option>
                @foreach(Helper::getAllCategory() as $cat)
                    <option>{{$cat->title}}</option>
                @endforeach
            </select>
            <form method="POST" action="{{route('product.search')}}">
                @csrf
                <input name="search" placeholder="Buscar Productos aquí....." type="search">
                <button class="btnn" type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
    </div>
</section>