@extends('index')
@section('content')
<section class="container">
    <div class="row">
        <div class="col-lg-8 shadow-box-right pt-2 pt-lg-4 pb-md-4 pb-xxl-5">
            {{\Breadcrumbs::render('news',$currentItem,$parent)}}
            <h1 class="fs-30-cv robotob mb-1 lh-13 wow fadeInUp">{{$currentItem->name}}</h1>
            <div class="title-info-new d-flex flex-wrap align-items-center justify-content-between my-3 pb-0 pb-xl-2 wow fadeInUp" data-wow-delay="0.2s">
                <div class="author_info d-flex align-items-center mb-2 me-3">
                    <a href="" class="smooth img" title="">
                        <img src="frontend/images/Untitled-1.png" title="" alt="" class="img-fluid smooth">
                    </a>
                    <div class="content lh-13">
                        <p>Tham vấn chuyên môn bài viết</p>
                        <a href="" class="smooth d-inline-block robotob hv-main fs-16" title="">
                            TTND.TS. Bác sĩ CKII NGUYỄN HUY BẠO
                        </a>
                        <p class="fs-16">Cập nhật: 15/03/2021</p>
                    </div>
                </div>
                <div class="title-info-rating d-flex align-items-center mb-2">
                    <button class="me-2">
                        <img src="frontend/images/font-size.png" title="" alt="" class="img-fluid smooth">
                    </button>
                    <div class="rating-info">
                        <img src="frontend/images/rating.png" title="" alt="" class="img-fluid smooth">
                    </div>
                </div>
            </div>
            <div class="short-content-new robotob fs-16 wow fadeInUp" data-wow-delay="0.4s"> {{$currentItem->short_content}}
            </div>
            <div class="s-content my-3 new-content-main wow fadeInUp" data-wow-delay="0.6s">
                {!!$currentItem->content!!}
            </div>
            <div class="rating-new-info d-flex align-items-center flex-wrap wow fadeInUp">
                <div class="view d-flex align-items-center me-4">
                    <i class="fa fa-eye me-1" aria-hidden="true"></i>
                    <span class="number-count">5.9K</span>
                </div>
                <div class="action me-3">
                    <button class="like me-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                    <button class="un-like"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
                </div>
                <p>Bài viết hữu ích?</p>
            </div>
            <div class="the-new-source d-flex justify-content-between flex-wrap my-3 pb-2 wow fadeInUp">
                <div class="new-source me-2">
                    <p class="fs-16 robotob">
                        <i class="fa fa-plus me-1" aria-hidden="true"></i>
                        <span>Nguyền tham khảo</span>
                    </p>
                </div>
                <p class="publisher fs-16">
                    <span>Tác giả:</span>
                    <span class="robotob">{{}}</span>
                </p>
            </div>
            <div class="share-new d-flex flex-wrap justify-content-between wow fadeInUp">
                <div class="rating-info mb-2">
                    <span class="me-2 fs-16">Đánh giá bài viết:</span>
                    <img src="frontend/images/rating.png" title="" alt="" class="img-fluid smooth">
                </div>
                <div class="share">
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style mb-2">
                        <a class="a2a_dd"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_email"></a>
                        <a class="a2a_button_pinterest"></a>
                        <a class="a2a_button_instagram"></a>
                    </div>
                </div>
            </div>
            <div class="tag-new d-flex align-items-center flex-wrap my-3 my-xl-4 wow fadeInUp">
                <span class="fs-15 me-3 mb-2"><i class="fa fa-tag me-1" aria-hidden="true"></i>Chủ đề</span>
                <a href="" class="item-tag mb-2 me-2" title="">Ốm nghén</a>
                <a href="" class="item-tag mb-2 me-2" title="">Ốm nghén</a>
                <a href="" class="item-tag mb-2 me-2" title="">Ốm nghén</a>
                <a href="" class="item-tag mb-2 me-2" title="">Ốm nghén</a>
                <a href="" class="item-tag mb-2 me-2" title="">Ốm nghén</a>
                <a href="" class="item-tag mb-2 me-2" title="">Ốm nghén</a>
            </div>
            <div class="bottom-new-detail wow fadeInUp">
                <div class="main-wraper d-flex flex-wrap">
                    <div class="img">
                        <a href="" class="smooth c-img shine-effect" title="">
                            <img src="frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                        </a>
                    </div>
                    <div class="content">
                        <h3>
                            <a href="" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
                        </h3>
                        <p class="fs-16-cv my-1 my-xl-2">Đại trực tràng là một bộ phận thuộc hệ tiêu hóa và giữ vai trò nhất định trong cơ thể con người. Tuy nhiên, nhiều người vẫn chưa hiểu rõ cấu tạo, vị trí và chức năng của...</p>
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="item-time mt-1 me-3">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>06/09/2021</span>
                            </div>
                            <div class="new-cate-info mt-1">
                                <a href="" class="smooth" title="">SẢN PHỤ KHOA</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-subitem w-100">
                    <li><a href="" class="fs-20-cv">Khám thai lần đầu khi nào và những lưu ý quan trọng</a></li>
                </ul>
            </div>
            <div class="my-4 wow fadeInUp">
                <p class="side-bar-title robotob">VIDEO CÙNG CHỦ ĐỀ</p>
                <div class="video-youtybe-container-new mx-auto mt-3 mt-xl-4">
                    <div class="video-youtybe-container ">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/8ZH2zG-ruMI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <h3 class="mt-2 text-center">
                    <a href="" class="smooth fs-20 robotob hv-main-sp" title="">Đẻ là đến Phương Đông - Đẻ gì mà sướng ghê!</a>
                </h3>
            </div>
            <div class="relate-new">
                <p class="side-bar-title robotob wow fadeInUp">BÀI VIẾT CÙNG CHỦ ĐỀ</p>
                <div class="relate-new-big d-flex flex-wrap mt-3 mt-lg-4 pb-3 pb-lg-4 wow fadeInUp">
                    <div class="img order-md-2">
                        <a href="" class="smooth c-img shine-effect" title="">
                            <img src="frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                        </a>
                    </div>
                    <div class="content">
                        <h3>
                            <a href="" class="smooth hv-main-sp fs-22-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
                        </h3>
                        <p class="fs-16-cv my-1 my-xl-2">Đại trực tràng là một bộ phận thuộc hệ tiêu hóa và giữ vai trò nhất định trong cơ thể con người. Tuy nhiên, nhiều người vẫn chưa hiểu rõ cấu tạo, vị trí và chức năng của...</p>
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="item-time mt-1 me-3">
                                <span>12/07/2021 20:33</span>
                            </div>
                            <div class="new-cate-info mt-1">
                                <a href="" class="smooth" title="">SẢN PHỤ KHOA</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relate-item">
                    <?php for ($i = 1; $i < 5; $i++) { ?>
                        <div class="relate-new-small d-flex flex-wrap py-3 wow fadeInUp">
                            <div class="img order-md-2">
                                <a href="" class="smooth c-img shine-effect" title="">
                                    <img src="frontend/images/Layer 660.png" title="" alt="" class="img-fluid smooth">
                                </a>
                            </div>
                            <div class="content">
                                <h3>
                                    <a href="" class="smooth hv-main-sp fs-20-cv robotob lh-13" title="">Thuốc điều trị sỏi thận uống chúng với kim tiền thảo được không?</a>
                                </h3>
                                <p class="fs-16-cv my-1">Sau những phút vui mừng khi thấy chiếc que thử thai hai vạch, lần khám thai đầu tiên chính là khiến chị em cảm thấy hồi hộp xen...</p>
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="item-time mt-1 me-3">
                                        <span>12/07/2021 20:33</span>
                                    </div>
                                    <div class="new-cate-info mt-1">
                                        <a href="" class="smooth" title="">SẢN PHỤ KHOA</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-4">
            @include('news_categories.sidebar')
        </div>
    </div>
</section>
@stop
@section('jsl')
    <script src="theme/frontend/js/share-btn.js" defer></script>
@stop