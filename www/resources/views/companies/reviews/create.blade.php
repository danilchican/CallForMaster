{!! Form::open(array( 'url' => route('reviews.create'), 'id' => 'create-review-form' )) !!}
<input type="hidden" value="{{ $company->id }}" name="company-id">
<div class="form-group">
    <label for="author-name">Представьтесь, пожалуйста:</label>
    <input type="text" class="form-control" id="author-name" name="author" placeholder="Ваше имя">
</div>
<div class="form-group">
    <label for="author-email">Ваш email:</label>
    <input type="text" class="form-control" id="author-email" name="email">
</div>
<div class="form-group">
    <label for="author-phone">Ваш телефон:</label>
    <input type="text" class="form-control" id="author-phone" name="phone">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="advantages">Достоинства:</label>
            <textarea class="form-control" rows="5" name="advantages"></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="disadvantages">Недостатки:</label>
            <textarea class="form-control" rows="5" name="disadvantages"></textarea>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary save-button">Оставить отзыв</button>
{!! Form::close() !!}