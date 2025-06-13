<template>
     
    <section class="position-relative" style="margin-top: -75px; margin-bottom: -25px">
        <div v-if="loadingTogoPolitique">
        </div>
        <div v-else class="container">
            <div  class="row ">
                <div class="mb-2">
                    <a href="#" class="card-img-flash d-block">
                        <img src="https://actualitetogo.com/assets/images/adv-3.png" alt="adv">
                    </a>
                </div>
                <!-- Main Post START -->
                <div class="col-lg-9">
                    <!-- Entertainment START -->
                    <div class="col-md-12 ">

                        <div class="d-flex mb-2">
                            <div>
                                <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-83.png" class="alaune_logo" alt="Icones-TAAsset-83.png">
                            </div>
                            <div>&nbsp; &nbsp; &nbsp;</div>
                            <div>
                                <h2 class="text-success m-0 alaune_title">TOGO POLITIQUE</h2>
                                <p>Suivez nos actualités sur la politique togolaise.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Title -->
                                <Splide :options="optionsOneTogoPolitique" aria-label="My Favorite Images">

                                    <SplideSlide v-for="result in togoPolitiqueData.politiqueFirst" :key="result.id">
                                        <div style="margin: 5px">
                                            <div class="card">
                                                <!-- Card img -->
                                                <div class="position-relative">
                                                    <img class="card-img" :src='getImage(result.image_cover_url)' style="height: 260px; width: 550px ; object-fit: cover" :alt='result.title'>

                                                </div>
                                                <div class="card-body px-0 pt-3">
                                                    <h6 class="card-title"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title_truncate"></span></h6>
                                                    <div>
                                                        <div v-html="result.truncate_content">  </div>
                                                    </div>
                                                    <ul class="nav nav-divider align-items-center  d-sm-inline-block" style="font-size: 12px">
                                                        <li class="nav-item">
                                                            <div class="nav-link">
                                                                <div class="d-flex align-items-center position-relative">
                                                                    <div class="avatar avatar-xs">
                                                                        <div class="avatar-img rounded-circle bg-success">
                                                                            <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ result.author_name[0].toUpperCase()  }}{{ result.author_name[1].toUpperCase()  }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <span class="ms-3">par <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </SplideSlide>
                                </Splide>
                            </div>
                            <!-- Divider -->
                            <div class="border-bottom border-primary border-2 opacity-1 my-2"></div>
                            <!-- Card item START -->
                            <div class="container">
                                <div class="card border rounded-3 up-hover p-4 mt-2 mb-2"  v-for="result in togoPolitiqueData.politiqueTwo" :key="result.id">
                                    <div class="row g-3">
                                        <div class="col-sm-8">
                                            <!-- Title -->
                                            <h5 class="card-title">
                                                <span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title "></span>
                                            </h5>

                                            <div v-html="result.truncate_content_max">

                                            </div>
                                            <!-- Card info -->
                                            <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 12px">
                                                <li class="nav-item">
                                                    <div class="nav-link">
                                                        <div class="d-flex align-items-center position-relative">
                                                            
                                                            <span class="ms-3"> <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                 
                                            </ul>
                                        </div>
                                        <!-- Image -->
                                        <div class="col-sm-4">
                                            <img class="rounded-3" :src='getImage(result.image_cover_url)' style="height: 220px; width: 700px ;object-fit:cover" :alt='result.title'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card item END -->
                            <div class="border-bottom border-primary border-2 opacity-1 my-2"></div>

                            <div class="row">
                                <div class="col-12 col-md-6"  v-for="result in togoPolitiqueData.politiqueThree" :key="result.id">
                                    <div class="card mb-3">
                                        <div class="row g-3">
                                            <div class="col-4">
                                                <img class="rounded" :src='getImage(result.image_cover_url)' style="height: 80px; width: 550px ; object-fit: cover" :alt='result.title'>
                                            </div>
                                            <div class="col-8">
                                                <h6><span @click="article(result.slug)" style="cursor: pointer" class="btn-link stretched-link text-reset fw-bold" v-html="result.title_truncate"></span></h6>
                                                <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 11px">
                                                    <li class="nav-item">
                                                        <div class="nav-link">
                                                            <div class="d-flex align-items-center position-relative">
                                                                
                                                                <span class="ms-3">  <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                     
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <!-- Podcast social START -->
                    <div class="row g-2">
                        <!-- Facebook -->
                        <div class="col-4">
                            <a href="https://www.facebook.com/Togoactualite-148480121847124" target="_blank" class="bg-facebook rounded text-center text-white-force p-3 d-block">
                            <i class="fab fa-facebook-square fs-5 mb-2"></i>
                            <h6 class="m-0">1.5K</h6>
                            <span class="small">Abonnés</span>
                            </a>
                        </div>
                        <!-- Twitter -->
                        <div class="col-4">
                            <a href="https://x.com/Togoactualite" target="_blank" class="bg-dark rounded text-center text-white-force p-3 d-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x fs-5 mb-2" viewBox="0 0 16 16">
                                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                            </svg>
                            <h6 class="m-0">5K</h6>
                            <span class="small">abonnés</span>
                            </a>
                        </div>
                        
                        <!-- Whatsapp -->
                        <div class="col-4">
                            <a href="https://wa.link/qf0v9s" target="_blank" class="bg-success rounded text-center text-white-force p-3 d-block">
                            <i class="fab fa-whatsapp fs-5 mb-2"></i>
                            <h6 class="m-0">Nous</h6>
                            <span class="small">Joindre</span>
                            </a>
                        </div>
                     
                    </div>

                    <div>
                        <h5 class="mt-4 mb-3">Catégories populaires:</h5>
                        <div v-for="info in togoPolitiqueData.categories" :key="info.id">
                            <!-- Category item -->
                            <div class="mt-1 d-flex justify-content-between align-items-center bg-primary bg-opacity-15 rounded p-2 position-relative"    style="cursor: pointer"  @click="category(info.slug)">
                                <h6 class="m-0 text-primary text-uppercase">{{ info.name }} </h6>
                                <span  class="badge bg-primary text-light stretched-link">{{ info.count_publications }}</span>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="/all-category" class="fw-bold text-body text-primary-hover"><u>Voir toutes les catégories</u></a>
                        </div>
                    </div>
                    <!-- Podcast social END -->
                    <!-- Entertainment START -->
                    <div class="col-12 col-sm-6 col-lg-12 mt-3">
                        <div class="d-flex mb-2"> 
                            <h6 class="text-success m-0 alaune_title">Les plus populaires</h6> 
                        </div>
                        <div class="card mb-3"  v-for="result in togoPolitiqueData.populars" :key="result.id">
                            <div class="row g-3">
                                <div class="col-4">
                                    <img class="rounded" :src='getImage(result.image_cover_url)' style="height: 80px; width: 550px ; object-fit: cover" :alt='result.title'>
                                </div>
                                <div class="col-8">
                                    <h6><span @click="article(result.slug)" style="cursor: pointer" class="btn-link stretched-link text-reset fw-bold" v-html="result.title_truncate"></span></h6>
                                    <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 11px">
                                         
                                        <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                         
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ADV widget START -->
                    <div class="col-12 col-sm-6 col-lg-12 my-4">
                        <a href="#" class="d-block card-img-flash">
                            <img src="https://actualitetogo.com/assets/images/adv.png" alt="adv.png">
                        </a>
                        <div class="smaller text-end mt-2">ads via <a href="#" class="text-body"><u>Bootstrap</u></a></div>
                    </div>
                    <!-- ADV widget END -->
                </div>
            </div>
        </div>
        <div v-if="loadingANePasManquerTogo">
        </div>
        <div v-else >
            <div class="row g-4 mb-4 mt-2" >
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="container"> 
                        
                        <div class="col-md-12 ">
                            <div class="mb-2">
                                <a href="#" class="card-img-flash d-block">
                                    <img src="https://actualitetogo.com/assets/images/adv-3.png" alt="adv">
                                </a>
                            </div>
                            <div class="d-flex mb-2">
                                <div>
                                    <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-87.png" class="alaune_logo" alt="Icones-TAAsset-87.png">
                                </div>
                                <div>&nbsp; &nbsp; &nbsp;</div>
                                <div>
                                    <h2 class="text-success m-0 alaune_title">A NE PAS RATER TOGO</h2>
                                    <p>Nos actualités togolaise à ne pas rater.</p>
                                </div>
                            </div> 
                        </div>                    
                        <!-- Title -->
                    </div>
                    <div class="container">
                        <Splide :options="optionsOneANePasManquerTogo" aria-label="My Favorite Images">

                            <SplideSlide v-for=" result in aNePasManquerTogoData.anepasmanquer" :key="result.id">
                                <div>
                                    <div class="card card-overlay-bottom card-img-scale">
                                        <!-- Card Image -->
                                        <img class="card-img important_first_section_img_responsive" :src='getImage(result.image_cover_url)' :alt='result.title'>
                                        <!-- Card Image overlay -->
                                        <div class="card-img-overlay rounded-0 d-flex align-items-center"> 
                                            <div class="container px-3 my-auto">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <!-- Card title -->
                                                        <h2 class="text-white display-5"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-normal" v-html="result.title_truncate"></span></h2>
                                                        <div class="text-white-force">
                                                            <div v-html="result.truncate_content">  </div>
                                                        </div>
                                                        <!-- Card info -->
                                                        <ul class="nav nav-divider align-items-center text-white-force d-none d-sm-inline-block" style="font-size: 12px">
                                                            <li class="nav-item">
                                                                <div class="nav-link">
                                                                    <div class="d-flex align-items-center position-relative">
                                                                        <div class="avatar avatar-xs">
                                                                            <div class="avatar-img rounded-circle bg-success">
                                                                                <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ result.author_name[0].toUpperCase()  }}{{ result.author_name[1].toUpperCase()  }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="ms-3">par <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-comment-alt me-1"></i> {{ result.comment_count }}</a></li>
                                                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-thumbs-up me-1"></i> {{ result.likes_count }}</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </SplideSlide>
                        </Splide>
                    </div>
                   

                </div>
            </div>
        </div>
    </section> 
    <section class="position-relative" style=" margin-top: -40px; margin-bottom: -25px">
        <div class="container"> 
            <div v-if="loadingInternationalFenetreSurLAfriqueSports">
            </div>
            <div v-else class="row mb-4">
                <div class="mb-2">
                    <a href="#" class="card-img-flash d-block">
                        <img src="https://actualitetogo.com/assets/images/adv-3.png" alt="adv">
                    </a>
                </div>
                <!-- Main Post START -->
                <div class="col-lg-8">
                    <!-- Entertainment START -->
                    <div class="col-md-12 ">
                        <div class="d-flex mb-2">
                            <div>
                                <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-87.png" class="alaune_logo" alt="Icones-TAAsset-87.png">
                            </div>
                            <div>&nbsp; &nbsp; &nbsp;</div>
                            <div>
                                <h2 class="text-success m-0 alaune_title">INTERNATIONAL</h2>
                                <p>Suivez nos actualités a l'international.</p>
                            </div>
                        </div>
                        <!-- Card item START -->
                    
                        <div class="card border rounded-3 up-hover p-4 mt-2 mb-2"  v-for="result in internationalFenetreSurLAfriqueSportsData.internationalTwo" :key="result.id">
                            <div class="row g-3">
                                <div class="col-sm-8">
                                    <!-- Title -->
                                    <h5 class="card-title">
                                        <span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title"></span>
                                    </h5>
        
                                    <div v-html="result.truncate_content_max">
        
                                    </div>
                                    <!-- Card info -->
                                    <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 12px">
                                        <li class="nav-item">
                                            <div class="nav-link">
                                                <div class="d-flex align-items-center position-relative">
                                                    
                                                    <span class="ms-3">  <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                        
                                    </ul>
                                </div>
                                <!-- Image -->
                                <div class="col-sm-4">
                                    <img class="rounded-3" :src='getImage(result.image_cover_url)' style="height: 220px; width: 700px ;object-fit:cover" :alt='result.title'>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Divider -->
                        <div class="border-bottom border-primary border-2 opacity-1 my-2"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Title -->
                                <Splide :options="optionsOneInternationalFenetreSurLAfriqueSports" aria-label="My Favorite Images">
        
                                    <SplideSlide v-for="result in internationalFenetreSurLAfriqueSportsData.internationalFirst" :key="result.id">
                                        <div  style="margin: 5px">
                                            <div class="card card-overlay-bottom card-img-scale">
                                                <!-- Card Image -->
                                                <img class="card-img international_first_section_img_responsive" :src='getImage(result.image_cover_url)' :alt='result.title'>
                                                <!-- Card Image overlay -->
                                                <div class="card-img-overlay d-flex flex-column ">
                                                    <div class="w-100 mt-auto">
        
                                                        <!-- Card title -->
                                                        <h5 class="text-white"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title"></span></h5>
                                                        <!-- Card info -->
                                                        <ul class="nav nav-divider align-items-center text-white-force text-uppercase d-sm-inline-block" style="font-size: 11px">
                                                            <li class="nav-item">
                                                                <div class="nav-link">
                                                                    <div class="d-flex align-items-center position-relative">
                                                                        
                                                                        <span class="ms-3">  <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </SplideSlide>
                                </Splide>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12 mt-3">
                            <div class="d-flex mb-2"> 
                                <h5 class="text-success m-0 alaune_title">JUSTICE</h5> 
                            </div>
                            <div class="card mb-3"  v-for="result in togoPolitiqueData.populars" :key="result.id">
                                <div class="row g-3">
                                    <div class="col-4">
                                        <img class="rounded" :src='getImage(result.image_cover_url)' style="height: 80px; width: 550px ; object-fit: cover" :alt='result.title'>
                                    </div>
                                    <div class="col-8">
                                        <h6><span @click="article(result.slug)" style="cursor: pointer" class="btn-link stretched-link text-reset fw-bold" v-html="result.title_truncate"></span></h6>
                                        <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 11px">
                                             
                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                             
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main Post START -->
                        <div class="col-lg-12">
                            <div class="col-md-12 ">
                                <div class="d-flex mb-2">
                                    <div>
                                        <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-79.png" class="alaune_logo" alt="Icones-TAAsset-79.png">
                                    </div>
                                    <div>&nbsp; &nbsp; &nbsp;</div>
                                    <div>
                                        <h4 class="text-success m-0 alaune_title">FENETRE SUR L'AFRIQUE</h4>
                                        <p>Suivez nos actualités sur l'afrique.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <!-- Title -->
                                    <Splide :options="optionsOneFenetreSurLAfrique" aria-label="My Favorite Images">
            
                                        <SplideSlide v-for="result in internationalFenetreSurLAfriqueSportsData.afrique" :key="result.id">
                                            <div  style="margin: 5px">
                                                <div class="card card-overlay-bottom card-img-scale">
                                                    <!-- Card Image -->
                                                    <img class="card-img international_first_section_img_responsive" :src='getImage(result.image_cover_url)' :alt='result.title'>
                                                    <!-- Card Image overlay -->
                                                    <div class="card-img-overlay d-flex flex-column ">
                                                        <div class="w-100 mt-auto">
            
                                                            <!-- Card title -->
                                                            <h6 class="text-white"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title"></span></h6>
                                                            <!-- Card info -->
                                                            <ul class="nav nav-divider align-items-center text-white-force text-uppercase d-sm-inline-block" style="font-size: 11px">
                                                                <li class="nav-item">
                                                                    <div class="nav-link">
                                                                        <div class="d-flex align-items-center position-relative">
                                                                            
                                                                            <span class="ms-3">  <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </SplideSlide>
                                    </Splide>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    
                    <div class="row">
                        <!-- Main Post START -->
                        <div class="col-lg-12 mt-4">
                            <div class="col-md-12 ">
                                <div class="d-flex mb-2">
                                    <div>
                                        <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-89.png" class="alaune_logo" alt="Icones-TAAsset-89.png">
                                    </div>
                                    <div>&nbsp; &nbsp; &nbsp;</div>
                                    <div>
                                        <h2 class="text-success m-0 alaune_title">SPORTS</h2>
                                        <p>Suivez nos actualités du monde du sport.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Title -->
                                    <Splide :options="optionsOneSports" aria-label="My Favorite Images">
            
                                        <SplideSlide v-for="result in internationalFenetreSurLAfriqueSportsData.sports" :key="result.id">
                                            
                                            <div style="margin: 5px">
                                                <div class="card card-fold bg-light">
                                                    <div class="card-body p-4">
                                                        <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 12px">
                                                            <li class="nav-item">
                                                                <div class="nav-link">
                                                                    <div class="d-flex align-items-center position-relative">
                                                                        
                                                                        <span class="ms-3"> <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                            
                                                        </ul>
                                                        <h6 class="card-title"><span @click="article(result.slug)" style="cursor: pointer" class="stretched-link text-reset" v-html="result.title_truncate"></span></h6>
                                                        <p class="m-0" v-html="result.truncate_content"></p>
                                                    </div>
                                                    <img class="card-img-bottom international_first_section_img_responsive" :src='getImage(result.image_cover_url)' alt="Card image">
                                                </div>
                                            </div>
                                        </SplideSlide>
                                    </Splide>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div v-if="loadingSociete">
            </div>
            <div v-else class="mb-4">
                <div class="row"> 
                    <div class="mb-2">
                        <a href="#" class="card-img-flash d-block">
                            <img src="https://actualitetogo.com/assets/images/adv-3.png" alt="adv">
                        </a>
                    </div>
                    <!-- Title -->
                    <div class="col-lg-9">
        
        
                        <div class="col-md-12 ">
                            <div class="d-flex mb-2">
                                <div>
                                    <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-79.png" class="alaune_logo" alt="Icones-TAAsset-79.png">
                                </div>
                                <div>&nbsp; &nbsp; &nbsp;</div>
                                <div>
                                    <h2 class="text-success m-0 alaune_title">SOCIETE</h2>
                                    <p>Suivez nos actualités sur la Societé.</p>
                                </div>
                            </div>
                            <!-- Title -->
        
                        </div>
        
                        <div class="row">
        
                            <div class="col-sm-6 col-lg-6" v-for="result in societeData.societe" :key="result.id">
                                <div class="card">
                                    <!-- Card img -->
                                    <div class="position-relative">
                                        <img class="card-img" :src='getImage(result.image_cover_url)' style="height: 260px; width: 550px ; object-fit: cover" alt="Card image">
        
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h6 class="card-title"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                                        <div>
                                            <div v-html="result.truncate_content">  </div>
                                        </div>
                                        <ul class="nav nav-divider align-items-center  d-sm-inline-block" style="font-size: 12px">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">
                                                        <div class="avatar avatar-xs">
                                                            <div class="avatar-img rounded-circle bg-success">
                                                                <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ result.author_name[0].toUpperCase()  }}{{ result.author_name[1].toUpperCase()  }}</span>
                                                            </div>
                                                        </div>
                                                        <span class="ms-3">par <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-5" v-if="!societeLoadButtonStatus">
                                <button type="button" @click="societeLoadButton" class="btn btn-success-soft">Voir plus<i class="bi bi-arrow-down-circle ms-2 align-middle"></i></button>
                            </div>
                            <div class="col-sm-6 col-lg-6" v-else-if="societeLoadButtonStatus" v-for="result in societeData.societeLoad" :key="result.id">
                                <div class="card">
                                    <!-- Card img -->
                                    <div class="position-relative">
                                        <img class="card-img" :src='getImage(result.image_cover_url)' style="height: 260px; width: 550px ; object-fit: cover" alt="Card image">
        
                                    </div>
                                    <div class="card-body px-0 pt-3">
                                        <h6 class="card-title"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                                        <div>
                                            <div v-html="result.truncate_content">  </div>
                                        </div>
                                        <ul class="nav nav-divider align-items-center  d-sm-inline-block" style="font-size: 12px">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">
                                                        <div class="avatar avatar-xs">
                                                            <div class="avatar-img rounded-circle bg-success">
                                                                <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ result.author_name[0].toUpperCase()  }}{{ result.author_name[1].toUpperCase()  }}</span>
                                                            </div>
                                                        </div>
                                                        <span class="ms-3">par <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="row g-2">
                            <!-- Facebook -->
                            <div class="col-4">
                                <a href="https://www.facebook.com/Togoactualite-148480121847124" target="_blank" class="bg-facebook rounded text-center text-white-force p-3 d-block">
                                <i class="fab fa-facebook-square fs-5 mb-2"></i>
                                <h6 class="m-0">1.5K</h6>
                                <span class="small">Abonnés</span>
                                </a>
                            </div>
                            <!-- Twitter -->
                            <div class="col-4">
                                <a href="https://x.com/Togoactualite" target="_blank" class="bg-dark rounded text-center text-white-force p-3 d-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x fs-5 mb-2" viewBox="0 0 16 16">
                                    <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                </svg>
                                <h6 class="m-0">5K</h6>
                                <span class="small">abonnés</span>
                                </a>
                            </div>
                            
                            <!-- Whatsapp -->
                            <div class="col-4">
                                <a href="https://fr.linkedin.com/in/togoactualite-togo-actualit%C3%A9-3a076648" target="_blank" class="bg-linkedin rounded text-center text-white-force p-3 d-block">
                                <i class="fab fa-linkedin fs-5 mb-2"></i>
                                <h6 class="m-0">1.8K</h6>
                                <span class="small">Abonnés</span>
                                </a>
                            </div>
                         
                        </div>
                        <!-- Trending topics widget START -->
                        <div>
                            <h4 class="mt-4 mb-3">Mot clés populaires:</h4>
                            <div v-for="info in societeData.tags" :key="info.id">
                                <!-- Category item -->
                                <div class="mt-1 d-flex justify-content-between align-items-center bg-primary bg-opacity-15 rounded p-2 position-relative" >
        
                                    <h6 class="m-0 text-primary">#{{ info.name }} </h6>
                                    <span  @click="tag(info.slug)" style="cursor: pointer"  class="badge bg-primary text-light stretched-link">{{ info.count_publications }}</span>
        
                                </div>
        
                            </div>
                            <div class="text-center mt-3">
                                <a href="/search-posts" class="fw-bold text-body text-primary-hover"><u>Rechercher un article</u></a>
                            </div>
                        </div>
        
                        <div class="col-12 col-sm-6 col-lg-12 mt-3">
                            <div class="d-flex mb-2">
                                
                                <div>
                                    <h6 class="text-success m-0 alaune_title">Les plus aimés</h6> 
                                </div>
                            </div>
                            <div class="card mb-3"  v-for="result in societeData.populars" :key="result.id">
                                <div class="row g-3">
                                    <div class="col-4">
                                        <img class="rounded" :src='getImage(result.image_cover_url)' style="height: 80px; width: 550px ; object-fit: cover" :alt='result.title'>
                                    </div>
                                    <div class="col-8">
                                        <h6><span @click="article(result.slug)" style="cursor: pointer" class="btn-link stretched-link text-reset fw-bold" v-html="result.title_truncate"></span></h6>
                                        <ul class="nav nav-divider align-items-center text-uppercase d-sm-inline-block" style="font-size: 10px">
                                            <li class="nav-item">
                                                <div class="nav-link">
                                                    <div class="d-flex align-items-center position-relative">
                                                        
                                                        <span class="ms-3">  <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                             
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ADV widget START -->
                        <div class="col-12 col-sm-6 col-lg-12 my-4">
                            <a href="#" class="d-block card-img-flash">
                                <img src="https://actualitetogo.com/assets/images/adv.png" alt="adv.png">
                            </a>
                            <div class="smaller text-end mt-2">ads via <a href="#" class="text-body"><u>Bootstrap</u></a></div>
                        </div>
                        <!-- ADV widget END -->
                    </div>
                </div>
            </div>
            <div v-if="loadingOpinionFaitsDivers">
            </div>
            <div class="row g-4 mb-4" v-else> 
                <div class="mb-2">
                    <a href="#" class="card-img-flash d-block">
                        <img src="https://actualitetogo.com/assets/images/adv-3.png" alt="adv">
                    </a>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 ">
                        <div class="d-flex mb-2">
                            <div>
                                <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-87.png" class="alaune_logo" alt="">
                            </div>
                            <div>&nbsp; &nbsp; &nbsp;</div>
                            <div>
                                <h2 class="text-success m-0 alaune_title">OPINION</h2>
                                <p>Suivez nos actualités sur les opinions.</p>
                            </div>
                        </div>
                        <!-- Title -->
                    </div>
    
                    <Splide :options="optionsOneOpinionFaitsDivers" aria-label="My Favorite Images">
    
                        <SplideSlide v-for=" result in opinionFaitsDiversData.opinion" :key="result.id">
                            <div>
                                <div class="card card-overlay-bottom card-img-scale">
                                    <!-- Card Image -->
                                    <img class="card-img opinion_faits_divers_first_section_img_responsive" :src='getImage(result.image_cover_url)' alt="" >
                                    <!-- Card Image overlay -->
                                    <div class="card-img-overlay d-flex flex-column p-3 p-sm-4">
                                        <div class="w-100 mt-auto">
    
                                            <!-- Card title -->
                                            <h4 class="text-white"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title_truncate"></span></h4>
                                            <div class="text-white-force">
                                                <div v-html="result.truncate_content">  </div>
                                            </div>
                                            <!-- Card info -->
                                            <ul class="nav nav-divider align-items-center text-white-force text-uppercase d-sm-inline-block" style="font-size: 12px">
                                                <li class="nav-item">
                                                    <div class="nav-link">
                                                        <div class="d-flex align-items-center position-relative">
                                                            
                                                            <span class="ms-3"> <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </SplideSlide>
                    </Splide>
    
                </div>
    
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 ">
                        <div class="d-flex mb-2">
                            <div>
                                <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-88.png" class="alaune_logo" alt="">
                            </div>
                            <div>&nbsp; &nbsp; &nbsp;</div>
                            <div>
                                <h2 class="text-success m-0 alaune_title">FAITS DIVERS</h2>
                                <p>Suivez nos actualités sur les faits divers.</p>
                            </div>
                        </div>
                        <!-- Title -->
                    </div>
    
                    <Splide :options="optionsOneOpinionFaitsDivers" aria-label="My Favorite Images">
    
                        <SplideSlide v-for=" result in opinionFaitsDiversData.faitsDivers" :key="result.id">
                            <div>
                                <div class="card card-overlay-bottom card-img-scale">
                                    <!-- Card Image -->
                                    <img class="card-img opinion_faits_divers_first_section_img_responsive" :src='getImage(result.image_cover_url)' alt="">
                                    <!-- Card Image overlay -->
                                    <div class="card-img-overlay d-flex flex-column p-3 p-sm-4">
                                        <div class="w-100 mt-auto">
    
                                            <!-- Card title -->
                                            <h4 class="text-white"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset stretched-link" v-html="result.title_truncate"></span></h4>
                                            <div class="text-white-force">
                                                <div v-html="result.truncate_content">  </div>
                                            </div>
                                            <!-- Card info -->
                                            <ul class="nav nav-divider align-items-center text-white-force text-uppercase d-sm-inline-block" style="font-size: 12px">
                                                <li class="nav-item">
                                                    <div class="nav-link">
                                                        <div class="d-flex align-items-center position-relative">
                                                            
                                                            <span class="ms-3"> <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </SplideSlide>
                    </Splide>
                </div>
                <br>
            </div>
            <div v-if="loadingImportant">
            </div>
            <div v-else class="row mb-4">
                 
                <div class="col-lg-12">
                    <div class="mb-2">
                        <a href="#" class="card-img-flash d-block">
                            <img src="https://actualitetogo.com/assets/images/adv-3.png" alt="adv">
                        </a>
                    </div>
                    <!-- Entertainment START -->
                    <div class="col-md-12 ">
                        <div class="d-flex mb-2">
                            <div>
                                <img src="https://actualitetogo.com/assets/images/Icones_formes/Icones-TAAsset-87.png" class="alaune_logo" alt="">
                            </div>
                            <div>&nbsp; &nbsp; &nbsp;</div>
                            <div>
                                <h2 class="text-success m-0 alaune_title">IMPORTANT</h2>
                                <p>Suivez nos actualités importantes.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Title -->
                                <Splide :options="optionsOneImportant" aria-label="My Favorite Images">
    
                                    <SplideSlide v-for="result in importantData.importantFirst" :key="result.id">
                                        <div>
                                            <div class="card card-overlay-bottom card-img-scale">
                                                <!-- Card Image -->
                                                <img class="card-img important_first_section_img_responsive" :src='getImage(result.image_cover_url)' :alt='result.title'>
                                                <!-- Card Image overlay -->
                                                <div class="card-img-overlay rounded-0 d-flex align-items-center"> 
                                                    <div class="container px-3 my-auto">
                                                        <div class="row">
                                                            <div class="col-lg-7">
                                                                <!-- Card title -->
                                                                <h2 class="text-white display-5"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-normal" v-html="result.title_truncate"></span></h2>
                                                                <div class="text-white-force">
                                                                    <div v-html="result.truncate_content">  </div>
                                                                </div>
                                                                <!-- Card info -->
                                                                <ul class="nav nav-divider align-items-center text-white-force d-none d-sm-inline-block" style="font-size: 12px">
                                                                    <li class="nav-item">
                                                                        <div class="nav-link">
                                                                            <div class="d-flex align-items-center position-relative">
                                                                                <div class="avatar avatar-xs">
                                                                                    <div class="avatar-img rounded-circle bg-success">
                                                                                        <span class="text-light position-absolute top-50 start-50 translate-middle fw-bold">{{ result.author_name[0].toUpperCase()  }}{{ result.author_name[1].toUpperCase()  }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <span class="ms-3">par <span @click="author(result.author_slug)" style="cursor: pointer" class="stretched-link text-reset btn-link">{{ result.author_name }}</span></span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                                                                    <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-comment-alt me-1"></i> {{ result.comment_count }}</a></li>
                                                                    <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-thumbs-up me-1"></i> {{ result.likes_count }}</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </SplideSlide>
                                </Splide>
    
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>   
            <div class="mb-2">
                <a href="#" class="card-img-flash d-block">
                    <img src="https://actualitetogo.com/assets/images/adv-3.png" alt="adv">
                </a>
            </div>
        </div>  
    </section>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import moment from 'moment'
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
export default {
    components: {
        Splide,
        SplideSlide,
    },
    data(){
        return {
            loadingTogoPolitique: true,
            togoPolitiqueData: {},
            togoPolitiqueMessage: null,
            loadingCommentsPopulars: true,
            commentsPopularsData: {},
            commentsPopularsMessage: null,
            empty: 2,
            optionsOneTogoPolitique: {
                type : 'loop',
                autoplay: true,
                interval: 3000,
                perPage:2,
                pagination: false,
                breakpoints: {
                    640: {
                        perPage: 1,
                        pagination:false
                    },

                },
            },
            data: {
                email: null,
            },
            errors: {},
            loadingNewsLetter: false,
            loadingANePasManquerTogo: true,
            aNePasManquerTogoData: {},
            aNePasManquerTogoMessage: null,
            optionsOneANePasManquerTogo: {
                type : 'loop',
                autoplay: true,
                interval: 3000,
                breakpoints: {
                    640: {
                        perPage: 1,
                        pagination:false
                    },

                },
            },
            loadingInternationalFenetreSurLAfriqueSports: true,
            internationalFenetreSurLAfriqueSportsData: {},
            internationalFenetreSurLAfriqueSportsMessage: null,
            optionsOneInternationalFenetreSurLAfriqueSports: {
                type : 'loop',
                autoplay: true,
                interval: 3000,
                perPage:2,
                pagination: false,
                breakpoints: {
                    640: {
                        perPage: 1,
                        pagination:false
                    },

                },
            },
            optionsOneFenetreSurLAfrique: {
                type : 'loop',
                autoplay: true,
                interval: 3000,
                breakpoints: {
                    640: {
                        perPage: 1,
                        pagination:false
                    },

                },
            },
            optionsOneSports: {
                type : 'loop',
                autoplay: true,
                interval: 3000,
                perPage:4,
                pagination: false,
                breakpoints: {
                    640: {
                        perPage: 1,
                        pagination:false
                    },

                },
            },
            loadingSociete: true,
            societeData: {},
            societeMessage: null,
            societeLoadButtonStatus:false,
            loadingOpinionFaitsDivers: true,
            opinionFaitsDiversData: {},
            opinionFaitsDiversMessage: null,
            optionsOneOpinionFaitsDivers: {
                type : 'loop',
                autoplay: true,
                interval: 3000,
                breakpoints: {
                    640: {
                        perPage: 1,
                        pagination:false
                    },

                },
            },
            loadingImportant: true,
            importantData: {},
            importantMessage: null,
            optionsOneImportant: {
                type : 'loop',
                autoplay: true,
                interval: 3000,
                breakpoints: {
                    640: {
                        perPage: 1,
                        pagination:false
                    },

                },
            },
        }
    },

    computed:{
        ...mapGetters('homePage',{
            getterInfosTogoPolitiqueStatus:'getInfosTogoPolitiqueStatus',
            getterInfosTogoPolitiqueMessage:'getInfosTogoPolitiqueMessage',
            getterInfosTogoPolitiqueData:'getInfosTogoPolitiqueData',
            getterInfosANePasManquerTogoStatus:'getInfosANePasManquerTogoStatus',
            getterInfosANePasManquerTogoMessage:'getInfosANePasManquerTogoMessage',
            getterInfosANePasManquerTogoData:'getInfosANePasManquerTogoData',
            getterInfosInternationalFenetreSurLAfriqueSportsStatus:'getInfosInternationalFenetreSurLAfriqueSportsStatus',
            getterInfosInternationalFenetreSurLAfriqueSportsMessage:'getInfosInternationalFenetreSurLAfriqueSportsMessage',
            getterInfosInternationalFenetreSurLAfriqueSportsData:'getInfosInternationalFenetreSurLAfriqueSportsData',
            getterInfosSocieteStatus:'getInfosSocieteStatus',
            getterInfosSocieteMessage:'getInfosSocieteMessage',
            getterInfosSocieteData:'getInfosSocieteData',
            getterInfosOpinionFaitsDiversStatus:'getInfosOpinionFaitsDiversStatus',
            getterInfosOpinionFaitsDiversMessage:'getInfosOpinionFaitsDiversMessage',
            getterInfosOpinionFaitsDiversData:'getInfosOpinionFaitsDiversData',
            getterInfosImportantStatus:'getInfosImportantStatus',
            getterInfosImportantMessage:'getInfosImportantMessage',
            getterInfosImportantData:'getInfosImportantData',
            getterInfosCommentsPopularsStatus:'getInfosCommentsPopularsStatus',
            getterInfosCommentsPopularsMessage:'getInfosCommentsPopularsMessage',
            getterInfosCommentsPopularsData:'getInfosCommentsPopularsData',
        }),
        ...mapGetters('newsletter',{
            getterNewsletterStatus:'getNewsletterStatus',
            getterNewsletterMessage:'getNewsletterMessage',
            getterNewsletterErrors:'getNewsletterErrors',
        }),
    },
    methods:{

        ...mapActions('newsletter',{
            actionNewsletterRequest:'newsletterRequest'
        }),

        ...mapActions('homePage',{
            actionTogoPolitiqueDataRequest:'togoPolitiqueDataRequest',
            actionANePasManquerTogoDataRequest:'aNePasManquerTogoDataRequest',
            actionInternationalFenetreSurLAfriqueSportsDataRequest:'internationalFenetreSurLAfriqueSportsDataRequest',
            actionSocieteDataRequest:'societeDataRequest',
            actionOpinionFaitsDiversDataRequest:'opinionFaitsDiversDataRequest',
            actionImportantDataRequest:'importantDataRequest',
            actionCommentsPopularsDataRequest:'commentsPopularsDataRequest'
        }),


        async togoPolitique(){

            this.loadingTogoPolitique = true

            await this.actionTogoPolitiqueDataRequest({});

            if( this.getterInfosTogoPolitiqueStatus ==="success"){

                this.togoPolitiqueData = this.getterInfosTogoPolitiqueData

                this.empty = 0

                this.loadingTogoPolitique = false

                this.aNePasManquerTogo();

            }else if( this.getterInfosTogoPolitiqueStatus ==="empty"){

                this.togoPolitiqueMessage = this.getterInfosTogoPolitiqueMessage

                this.empty = 1

                this.loadingTogoPolitique = false

            }else{

                this.togoPolitiqueMessage = this.getterInfosTogoPolitiqueMessage

                this.empty = 3

                this.loadingTogoPolitique = false

            }
        },

        async aNePasManquerTogo(){

            this.loadingANePasManquerTogo = true

            await this.actionANePasManquerTogoDataRequest({});

            if( this.getterInfosANePasManquerTogoStatus ==="success"){

                this.aNePasManquerTogoData = this.getterInfosANePasManquerTogoData

                this.empty = 0

                this.loadingANePasManquerTogo = false

                this.internationalFenetreSurLAfriqueSports()

            }else if( this.getterInfosANePasManquerTogoStatus ==="empty"){

                this.aNePasManquerTogoMessage = this.getterInfosANePasManquerTogoMessage

                this.empty = 1

                this.loadingANePasManquerTogo = false

            }else{

                this.aNePasManquerTogoMessage = this.getterInfosANePasManquerTogoMessage

                this.empty = 3

                this.loadingANePasManquerTogo = false

            }
        },

        async internationalFenetreSurLAfriqueSports(){

            this.loadingInternationalFenetreSurLAfriqueSports = true

            await this.actionInternationalFenetreSurLAfriqueSportsDataRequest({});


            if( this.getterInfosInternationalFenetreSurLAfriqueSportsStatus ==="success"){

                this.internationalFenetreSurLAfriqueSportsData = this.getterInfosInternationalFenetreSurLAfriqueSportsData

                this.empty = 0

                this.loadingInternationalFenetreSurLAfriqueSports = false

                this.societe();

            }else if( this.getterInfosInternationalFenetreSurLAfriqueSportsStatus ==="empty"){

                this.internationalFenetreSurLAfriqueSportsMessage = this.getterInfosInternationalFenetreSurLAfriqueSportsMessage

                this.empty = 1

                this.loadingInternationalFenetreSurLAfriqueSports = false

            }else{

                this.internationalFenetreSurLAfriqueSportsMessage = this.getterInfosInternationalFenetreSurLAfriqueSportsMessage

                this.empty = 3

                this.loadingInternationalFenetreSurLAfriqueSports = false

            }
        },

        async societe(){

            this.loadingSociete = true

            await this.actionSocieteDataRequest({});

            if( this.getterInfosSocieteStatus ==="success"){

                this.societeData = this.getterInfosSocieteData

                this.empty = 0

                this.loadingSociete = false

                this.opinionFaitsDivers()

            }else if( this.getterInfosSocieteStatus ==="empty"){

                this.societeMessage = this.getterInfosSocieteMessage

                this.empty = 1

                this.loadingSociete = false

            }else{

                this.societeMessage = this.getterInfosSocieteMessage

                this.empty = 3

                this.loadingSociete = false

            }
        },

        async opinionFaitsDivers(){

            this.loadingOpinionFaitsDivers = true

            await this.actionOpinionFaitsDiversDataRequest({});

            if( this.getterInfosOpinionFaitsDiversStatus ==="success"){


                this.opinionFaitsDiversData = this.getterInfosOpinionFaitsDiversData

                this.empty = 0

                this.loadingOpinionFaitsDivers = false

                this.important()

            }else if( this.getterInfosOpinionFaitsDiversStatus ==="empty"){

                this.opinionFaitsDiversMessage = this.getterInfosOpinionFaitsDiversMessage

                this.empty = 1

                this.loadingOpinionFaitsDivers = false

            }else{

                this.opinionFaitsDiversMessage = this.getterInfosOpinionFaitsDiversMessage

                this.empty = 3

                this.loadingOpinionFaitsDivers = false

            }
        },

        async important(){

            this.loadingImportant = true

            await this.actionImportantDataRequest({});

            if( this.getterInfosImportantStatus ==="success"){


                this.importantData = this.getterInfosImportantData

                this.empty = 0

                this.loadingImportant = false 

            }else if( this.getterInfosImportantStatus ==="empty"){

                this.importantMessage = this.getterInfosImportantMessage

                this.empty = 1

                this.loadingImportant = false

            }else{

                this.importantMessage = this.getterInfosImportantMessage

                this.empty = 3

                this.loadingImportant = false

            }
        },

        async commentsPopulars(){

            this.loadingCommentsPopulars = true

            await this.actionCommentsPopularsDataRequest({});

            if( this.getterInfosCommentsPopularsStatus ==="success"){


                this.commentsPopularsData = this.getterInfosCommentsPopularsData

                this.empty = 0

                this.loadingCommentsPopulars = false

            }else if( this.getterInfosCommentsPopularsStatus ==="empty"){

                this.commentsPopularsMessage = this.getterInfosCommentsPopularsMessage

                this.empty = 1

                this.loadingCommentsPopulars = false

            }else{

                this.commentsPopularsMessage = this.getterInfosCommentsPopularsMessage

                this.empty = 3

                this.loadingCommentsPopulars = false

            }
        },

        async store(){
            this.loadingNewsLetter = true
            await this.actionNewsletterRequest({email: this.data.email})

            if (this.getterNewsletterStatus == "success") {

                this.loadingNewsLetter = false

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.getterNewsletterMessage
                })

                this.data.email = null

            }else if (this.getterNewsletterStatus == "error") {

                this.loadingNewsLetter = false

                this.errors = this.getterNewsletterErrors

            }else if (this.getterNewsletterStatus == "failed") {

                this.loadingNewsLetter = false

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.getterNewsletterMessage
                })

            }
        },

        getImage(slug){
            return slug;
        },

        author(slug){
            window.location = '/authors/' + slug
        },

        article(slug){
            window.location = '/' + slug
        },

        category(slug){
            window.location = '/' + slug
        },

        tag(slug){
            window.location = '/tags/' + slug
        },

        societeLoadButton(){
            this.societeLoadButtonStatus = true
        },

    },

    mounted(){
        this.moment = moment
        this.togoPolitique();
    }
}
</script>
