@extends('yaedp.media.layouts.app')

@section('title')
Participant’s Profile
@endsection

@section('meta-tags')

    <meta name="description" content="African Food Changemakers | Terms of Use" />
    <meta name="keywords" content="African Food Changemakers, Terms of Use" />

    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link rel="canonical" href="{{ Request::fullUrl() }}" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="African Food Changemakers | YAEDP | Terms of Use" />
    <meta property="og:description" content="African Food Changemakers | YAEDP | Terms of Use" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="African Food Changemakers" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="African Food Changemakers | YAEDP | Terms of Use" />
    <meta name="twitter:title" content="African Food Changemakers | YAEDP | Terms of Use" />
    <meta name="twitter:site" content="@nourish_africa" />
    <meta name="twitter:creator" content="@nourish_africa" />

    <script type='application/ld+json' class='yoast-schema-graph yoast-schema-graph--main'>
    {
   "@context":"https://schema.org",
   "@graph":[
      {
         "@type":"Organization",
         "@id":"https://nourishingafrica.com/#organization",
         "name":"African Food Changemakers",
         "url":"https://nourishingafrica.com/",
         "sameAs":[
            "https://www.facebook.com/nourishafrica1",
            "https://instagram.com/nourish_africa",
            "https://www.linkedin.com/company/28506256",
            "https://twitter.com/nourish_africa"
         ],
         "logo":{
            "@type":"ImageObject",
            "@id":"https://nourishingafrica.com/#logo",
            "url":"https://nourishingafrica.com/wp-content/uploads/2019/04/NA-1-Official.png",
            "width":848,
            "height":519,
            "caption":"African Food Changemakers"
         },
         "image":{
            "@id":"https://nourishingafrica.com/#logo"
         }
      },
      {
         "@type":"WebSite",
         "@id":"https://nourishingafrica.com/#website",
         "url":"https://nourishingafrica.com/",
         "name":"African Food Changemakers",
         "description":"African Food Changemakers | YAEDP | Terms of Use",
         "publisher":{
            "@id":"https://nourishingafrica.com/#organization"
         },
         "potentialAction":{
            "@type":"SearchAction",
            "target":"https://nourishingafrica.com/?s={search_term_string}",
            "query-input":"required name=search_term_string"
         }
      },
      {
         "@type":"WebPage",
         "@id":"https://nourishingafrica.com/#webpage",
         "url":"{{ Request::fullUrl() }}",
         "inLanguage":"en-US",
         "name":"African Food Changemakers | YAEDP | Terms of Use",
         "isPartOf":{
            "@id":"https://nourishingafrica.com/#website"
         },
         "about":{
            "@id":"https://nourishingafrica.com/#organization"
         },
         "datePublished":"2019-12-03T12:51:31+00:00",
         "dateModified":"2020-02-07T15:22:22+00:00",
         "description":"African Food Changemakers | YAEDP | Terms of Use"
      }
   ]
}
</script>
@stop

@section('title')
    Terms of Use
@stop

@section('top-assets')
    <style>
        .privacy-policy-accordion-header {
            background: #046B60;
            color: #fff;
            border-radius: 0;
            padding: 18px 28px 19px;
        }

        .privacy-policy-accordion-body {
            background: #eeeded;
            padding: 35px 28px 25px;
            border-top: none;
        }

        .justify-text {
            text-align: justify;
            text-justify: inter-word;
        }

        .article-header {
            color: #006600;
        }

        .article-card {
            border-radius: 10px;
        }

        .btn-afc-orange {
            color: #DC5D01;
            border-color: #DC5D01;
            text-transform: none;
        }

        .btn-afc-green {
            color: #333333;
            border-color: #333333;
            text-transform: none;
        }
        .btn-afc-orange-green {
           
            border-color: #DDFFDD;
            text-transform: none;
            background-color: #DDFFDD;
        }
        .product-details > h5{ 
            font-family: Inter;
font-size: 18px;
font-weight: 500;
line-height: 22px;
letter-spacing: 0em;
text-align: left;
color:#333333;

        }
        .product-details >p{
            font-family: Inter;
font-size: 16px;
font-weight: 400;
line-height: 19px;
letter-spacing: 0em;
text-align: left;

        }
        .carousel-item >img{
            height: 466px;
        width: auto;
        object-fit:contain;
border-radius: 10px;

        }
.certificates{
padding: 30px;

}

    </style>
@stop

@section('content')

   

    <div class="container-fluid p-5  container-2">
        

        <ul class="nav">
            <li class="nav-item tab-heading " sty>
                <a class="nav-link tab-link-first" href="{{ route('yaedp.media.pictures') }}">Overview</a>
            </li>
            <li class="nav-item    tab-heading">
                <a class="nav-link " aria-current="page" href="{{ route('yaedp.media.pictures') }}">Media</a>
            </li>
            <li class="nav-item tab-heading">
                <a class="nav-link " href="{{ route('yaedp.articles.index') }}">YAEDP Articles</a>
            </li>
            <li class="nav-item  tab-heading-active">
                <a class="nav-link tab-link-last  tab-text-active" href="{{ route('yaedp.participant.profile') }}">Participant’s Profile</a>
            </li>

        </ul>

        <h5 class="mt-5 text-dark">
            Participant’s Profile
        </h5>

<p>{{ $product->value_chain->name }}/ {{ $product->user->name }}</p>
        <div class="border border-5  border-top-0 border-left-0 border-right-0"></div>
    </div>


  <div class="container-fluid p-5  container-2" style="margin-top: -90px;">
    <div class="row">

        <div class="col-md-6">
            
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($product->images as $image)  
                  <li data-target="#carouselExampleIndicators" data-slide-to="{{  $loop->iteration -1 }}" class="{{ $loop->iteration == 1 ? 'active': '' }}"></li>
                  @endforeach
                  {{-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> --}}
                </ol>
                <div class="carousel-inner">

                    @foreach ($product->images as $image)   
                  <div class="carousel-item active">
                    <img src="{{ $image->path.'/'.$image->image }}" class="d-block w-100" alt="...">
                  
                  </div>
                  @endforeach
                 
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 product-details">
                    <h6 class="text-afc-orange ">
                       {{$product->name}}
                    </h6>
                    <h5>
                        Type of product
                    </h5>
                    <p>
                        {{ $product->type }}
                    </p>

                    <h5>
                        Product Weight per pack
                    </h5>
                    <p>
                        {{ $product->weight_per_pack }}
                    </p>
                    <h5>
                        Product state / form
                    </h5>
                    <p>
                        Cocoa powder
                    </p>
                    <h5>
                        Quantitiy available
                    </h5>
                    <p>
                        {{ $product->quantity_available }}
                    </p>
                    <h5>
                        Nutitional information provided?
                    </h5>
                    <p>
                        Yes
                    </p>
                </div>
                <div class="col-md-6 product-details">
                   
                   <h5>
                    &nbsp;&nbsp;
                   </h5>
                   <h5>
                    Source of raw material
                   </h5>
                   <p>
                    Kogi State
                   </p>
                   <h5>
                    Organcally Produced
                   </h5>
                   <p>
                    Yes
                   </p>
                   <h5>
                    Packaging method
                   </h5>
                   <p>
                    {{ $product->packaging_method }}
                   </p>
                   <h5>
                    Organically produced?
                   </h5>
                   <p>
                    Yes
                   </p>
                   <h5>
                    How to prepare provided on the packaging?
                   </h5>
                   <p>
                    No
                   </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 ">
        <div class="col-md-6 container">
            <div class="card  shadow-none border border-dark p-3 certificates" style="
            ">
                <h5>
                    Certificates
                </h5>

              <div class="">

    <button type="button" class="btn btn-outline-primary btn-afc-orange rounded mb-3">NAFDAC Certificate</button> 


    <button type="button" class="btn btn-outline-primary btn-afc-orange rounded mb-3">BIL Certificate</button> 


    <button type="button" class="btn btn-outline-primary btn-afc-orange rounded mb-3">ISO Certificate</button> 


    <button type="button" class="btn btn-outline-primary btn-afc-orange rounded mb-3">BIL Certificate</button> 


    <button type="button" class="btn btn-outline-primary btn-afc-orange rounded mb-3">BIL Certificate</button> 


    <button type="button" class="btn btn-outline-primary btn-afc-orange rounded mb-3">BIL Certificate</button> 

              </div>
            </div>
        </div>
        <div class="col-md-6 ">
            
            <h5 class="product-detail-heading mt-4">
                About {{ $product->user->name }}
            </h5>
            <p class="product-details-text">
                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
            </p>
        
        </div>
    </div>

    <div class="row">
     <div class="col-md-6 container">
        <div class="card  shadow-none border-0  p-3 certificates">
        <h5>
            Product Parameters
          </h5>
          <p>
            Mould  Content - 3.5
          </p>
          <p>
            Moisture content - 07%
          </p>
          <p>
            Slaty - 4
          </p>
          <p>
            Bean Count - 22 / T
          </p>
          <p>
            Foreign Matter - 13
          </p>
        </div>
     </div>
     <div class="col-md-6">
        <h5>
            Contact Details
        </h5>
        <p>
            Email - {{ $product->user->email }}
        </p>
        <p>
            Mobile number -  {{ $product->user->phone }}
        </p>
        <p>
            Website -  {{ $product->user->website }}
        </p>
     </div>
    </div>
  </div>
       
        <br><br>





        <div class="bg-afc-orange-green ">
            <div class="bg-afc-orange-green container-fluid p-5 container-2">
                <h6 class="text-afc-orange">
                    Similar Products
                </h6>
                <div class="row">

                    @for ($i = 0; $i < 2; $i++)
                    <div class="col-sm-6 mb-3 rounded-5">
                        <div class="card border border-dark article-card shadow-none bg-afc-orange-green">


                            <div class="card-body ">

                                <p class="card-text ">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <img src="/images/Vector 2.png" alt="">
                                        <h6>Jelli Farms Ltd</h6>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('yaedp.participant.profile.show',1) }}"
                                            class="btn btn-outline-primary btn-afc-orange rounded">See all
                                            details</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card border border-dark article-card shadow-none rounded-0 bg-afc-orange-green" style="">
                                            <img src="/images/product_image_1.png" class="p-4 " alt="" style="height:300px;width: auto;object-fit:contain; ">
                                        </div>
                                        <button type="button" class="btn btn-primary mt-3 btn-afc-orange-green rounded-pill text-afc-orange">Certified &#10003;</button>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <h6>
                                                    Product Name
                                                </h6>
                                                <p>Reel Fruit & nut mix</p>
                                            </div>
                                            <div class="">
                                                <h6>Product Type</h6>
                                                <p class="text-right">Processed Food</p>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <h6>
                                                    Quantity Available
                                                </h6>
                                                <p>20,000 MT</p>
                                            </div>
                                            <div class="">
                                                <h6>Production Capacity</h6>
                                                <p class="text-right">30 T</p>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <h6>
                                                    Packaging
                                                </h6>
                                                <p>Flexibag</p>
                                            </div>
                                            <div class="">
                                                <h6>Weight</h6>
                                                <p class="text-right">14kg</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </p>

                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
          

        </div>
    </div>
    </div>

    <br><br>



    </section>
@stop
