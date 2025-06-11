 <!-- SVG decoration right START -->
<div class="container">
    <div class="row d-flex align-items-center my-2">
        <!-- Top bar left -->
        <!-- Top bar left -->
        @if(count($annonces) !== 0)
            <div class="col-12 bg-primary bg-opacity-10 p-2 rounded">
				<div class="d-sm-flex align-items-center text-center text-sm-start">
					<!-- Title -->
					<div class="me-3">
						<span class="badge bg-primary p-2 px-3">Annonces:</span>
					</div>
					<!-- Slider -->
					<div class="tiny-slider arrow-end arrow-xs arrow-white arrow-round arrow-md-none">
						<div class="tiny-slider-inner"
                        data-autoplay="true"
                        data-hoverpause="true"
                        data-gutter="0"
                        data-arrow="true"
                        data-dots="false"
                        data-items="1">
                            @foreach($annonces as $result)
                                <div>  <a href="#" class="text-reset btn-link"> {!! $result->title !!} </a></div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
        @else
            <div class="col-12 bg-primary bg-opacity-10 p-2 rounded">
				<div class="d-sm-flex align-items-center text-center text-sm-start">
					<!-- Title -->
					<div class="me-3">
						<span class="badge bg-primary p-2 px-3">Tendances:</span>
					</div>
					<!-- Slider -->
					<div class="tiny-slider arrow-end arrow-xs arrow-white arrow-round arrow-md-none">
						<div class="tiny-slider-inner"
                        data-autoplay="true"
                        data-hoverpause="true"
                        data-gutter="0"
                        data-arrow="true"
                        data-dots="false"
                        data-items="1">
                            @foreach($tendances as $result)
                                <div>  <a href="/{!! $result->slug !!}" class="text-reset btn-link"> {!! $result->title !!} </a></div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
        @endif

    </div>

    <!-- Divider -->
    <div class="border-bottom border-2 border-primary opacity-1"></div>

    <div class="row g-4" style="margin-top: -20px">
        
        <div class="col-lg-6 col-sm-12 col-xs-12">
            @include('sectionHomePage.alaUne.sections.alaUneFirstSection')
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
            @include('sectionHomePage.alaUne.sections.alaUneSecondSection')
        </div>

    </div>
</div>
