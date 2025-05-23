<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Kiri: Judul -->
            <div class="col-sm-6">
                <h1 class="font-weight-bold">{{ $breadcrumb->title }}</h1>
            </div>
            
            <!-- Kanan: Breadcrumb -->
            <div class="col-sm-6 text-end">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($breadcrumb->list as $key => $value)
                        @if ($key == count($breadcrumb->list) - 1)
                            <li class="breadcrumb-item active">{{ $value }}</li>
                        @else
                            <li class="breadcrumb-item">{{ $value }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>
