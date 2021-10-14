<div class="sidebar-all py-4">
    <form class="form-search-doctor mt-xl-2 mb-4 fs-16 position-relative wow fadeInUp" action="{{VRoute::get('searchDoctor')}}" method="get" accept-charset="utf8">
        <input type="text" name="q" placeholder="Tìm bác sĩ">
        <button type="submit" class="smooth"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
    <p class="all-sub-title wow fadeInUp mb-3">Bác sĩ chuyên khoa</p>
    <ul class="list-service-sidebar mt-2 fs-18 wow fadeInUp">
        @foreach ($listSpecialist as $item)
            <li><a href="doi-ngu-bac-si/{{$item->slug}}" class="smooth" title="{{$item->name}}"><i class="fa fa-angle-double-right me-2" aria-hidden="true"></i>{{$item->name}}</a></li>
        @endforeach
    </ul>
    @include('register_advise_form')
    @include('banner_gdn.banner_gdn_sidebar')
</div>