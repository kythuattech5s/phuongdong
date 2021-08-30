<div class="rating-score">
    <p class="score-big">{{$ratings['scoreAll']}}</p>
    <p class="count-comment">{{$ratings['totalRating']}} đánh giá</p>
    @include('path.rating',['rating'=>$ratings['percentAll']])
</div>