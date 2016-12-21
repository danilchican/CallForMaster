<div class="col-12 col-sm-12 col-lg-12 company-box">
    <div class="thumbnail">
            <div class="caption">
                <div class="col-md-3">
                    <div class="row">
                        <img class="featurette-image img-responsive" id="logo" alt="150x150" width="150" src="/{{ $logo_url = (empty($company->logo_url) && File::exists("uploads/images/".$company->logo_url))
                ? "backend/themes/default/images/no_logo.svg"
                : "uploads/images/".$company->logo_url }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <h4><a href="{{ route('companies.cart', $company->id) }}">{{ $company->name ? $company->name : 'Без имени' }}</a></h4>
                        <p>{{ $company->description }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <p style="margin: 0">Телефоны:</p>
                    <ul style="padding-left: 20px">
                        @foreach($company->contacts->phones()->filled()->get() as $phone)
                            <li>{{ $phone->number }}</li>
                        @endforeach
                    </ul>
                    <p style="margin: 0">Сайт:</p>
                    @if(!empty($website = $company->contacts->website_url)) <a href="{{ $website }}">{{ $website }}</a>
                    @else Не заполнено @endif
                </div>
            </div>
    </div>
</div>