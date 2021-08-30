<ul class="rating-list">
    <li>
        <div class="rating-list__item">
            <div class="progress-bar" role="progressbar" style="--percent:{{ $ratings['percentFiveStar'].'%' }} !important"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $ratings['percentFiveStar'] }}"></div> 
        </div>
        <div class="rating-list__star">
            @include('path.rating',['rating'=>'100%'])
            <p class="rating-list__star-percent">100%</p>
        </div>
    </li>
    <li>
        <div class="rating-list__item">
            <div class="progress-bar" role="progressbar" style="--percent:{{ $ratings['percentFourStar'].'%' }} !important"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $ratings['percentFourStar'] }}"></div>
        </div>
        <div class="rating-list__star">
            @include('path.rating',['rating'=>'80%'])
            <p class="rating-list__star-percent">80%</p>
        </div>
    <li>
        <div class="rating-list__item">
            <div class="progress-bar" role="progressbar" style="--percent:{{ $ratings['percentThreeStar'].'%' }} !important"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $ratings['percentThreeStar'] }}"></div>
        </div>
        <div class="rating-list__star">
            @include('path.rating',['rating'=>'60%'])
            <p class="rating-list__star-percent">60%</p>
        </div>
    <li>
        <div class="rating-list__item">
            <div class="progress-bar" role="progressbar" style="--percent:{{ $ratings['percentTwoStar'].'%' }} !important"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $ratings['percentTwoStar'] }}"></div>
        </div>
        <div class="rating-list__star">
            @include('path.rating',['rating'=>'40%'])
            <p class="rating-list__star-percent">40%</p>
        </div>
    <li>
        <div class="rating-list__item">
            <div class="progress-bar" role="progressbar" style="--percent:{{ $ratings['percentOneStar'].'%' }} !important"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $ratings['percentOneStar'] }}"></div>
        </div>
        <div class="rating-list__star">
            @include('path.rating',['rating'=>'20%'])
            <p class="rating-list__star-percent">20%</p>
        </div>
    </li>
</ul>