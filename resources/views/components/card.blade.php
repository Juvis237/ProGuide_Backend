<div class="col">
    <a href="{{ $link }}">
        <div class="card rounded-lg shadow-light border-0" style="width: 250px;">
            <div class="card-content" style="width: 294px;">
                <div class="card-body">
                    <div class="row media d-flex">
                        <div class="align-self-center">
                            <div class="icon-container rounded-lg" style="background-color: #E1F1FB; padding: 24px;">
                                <ion-icon src="{{ $icon }}"></ion-icon>
                            </div>
                        </div>
                        <div class="col media-body pl-2">
                            <span style="color: #000000; font-size: 16px; font-weight:700;">{{ $title }}</span>
                            <h3 style="color: #000000; font-size: 32px; font-weight:700;">{{ $figure }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>