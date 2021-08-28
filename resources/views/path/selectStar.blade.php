<div class="user-rating">
    <div class="rating" m-checked="Vui lòng đánh giá">
        @for ($i = 5; $i > 0; $i--)
            <input class="star star-{{ $i }}" id="star-{{ $i }}" type="radio"
                value="{{ $i }}" name="rate" />
            <label class="star star-{{ $i }}" for="star-{{ $i }}"></label>
        @endfor
    </div>
</div>
