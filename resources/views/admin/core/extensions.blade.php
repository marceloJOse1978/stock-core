<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4> {{$title}}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$title}}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">{{$title}}</h4>
                </div>
                <div
                    class="search-icon-box bg-white box-shadow border-radius-10 mb-30"
                >
                    <input
                        type="text"
                        class="border-radius-10"
                        id="filter_input"
                        placeholder="Pesquisar Extensão ..."
                    />
                    <i class="search_icon dw dw-search"></i>
                </div>
            </div>
            <div class="card-box mb-30">
                <div id="filter_list">
                    <div class="product-wrap">
                        <div class="product-list">
                            <ul class="row" >
                                <li class="col-lg-4 col-md-6 col-sm-12 fa-hover">
                                    <div class="product-box">
                                        <div class="producct-img">
                                            <img src="vendors/images/product-img1.jpg" alt="" />
                                        </div>
                                        <div class="product-caption">
                                            <h4><a href="#">Gufram Bounce Black</a></h4>
                                            <div class="price"><del>$55.5</del><ins>$49.5</ins></div>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio deserunt similique facilis qui iure voluptatibus consectetur numquam pariatur cum nostrum! Cupiditate amet adipisci ex totam officiis, numquam deserunt harum veritatis.</p>
                                            <a data-url="{{route("install.packs","Scanner")}}" class="btn btn-outline-primary install-itens">INSTALAR</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script>
$("body").on("click",".install-itens", function () {
    var url = $(this).data("url");
    window.location.href = url;
});
</script>     