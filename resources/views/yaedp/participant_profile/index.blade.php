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
        @media only screen and (max-width: 600px) {
 .rounded-pill{
    margin-bottom:20px; 
 }
 
.nav-link {
    margin-left: -10px;
}

}
h6{
    font-family: Inter;
font-style: normal;
font-weight: 900;
font-size: 16px;
line-height: 19px;
color: #585858;


}
h6 > p{
    font-family: Inter;
font-size: 16px;
font-weight: 400;
line-height: 19px;
letter-spacing: 0em;
text-align: left;

}
    </style>
@stop

@section('content')

    
    <div class="container-fluid p-5 p container-2">
        .

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


        <div class="border border-5  border-top-0 border-left-0 border-right-0"></div>

        <div class="row  pt-4 pb-4">
            @foreach ($valued_chains as $valued_chain)
            <div class="">
                <a href="{{ route('yaedp.participant.profile')."?valued_chain=$valued_chain->name"}}" class="btn btn-outline-primary  rounded-pill @if(returnActiveClass($_GET['valued_chain'] ?? '', $valued_chain->name , $loop->iteration)) btn-afc-orange @else  btn-afc-green @endif">{{ $valued_chain->name }}</a>
            </div>
            @endforeach
           
            {{-- <div class="">
                <a href="#" class="btn btn-outline-primary btn-afc-green rounded-pill">Cassava</a>
            </div> --}}
           
        </div>
        <div class="border border-5  border-top-0 border-left-0 border-right-0"></div>


        <h3 class="mt-4">
            Cocoa
        </h3>
        <br><br>





        <div class="">
            <div class="">
                
                <div class="row">

                    @foreach ($products as $product)
                        <div class="col-sm-6 mb-3 rounded-5">
                            <div class="card border border-dark article-card shadow-none">


                                <div class="card-body">

                                    <p class="card-text">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <img src="/images/Vector 2.png" alt="">
                                            <h6>{{ $product->user->name }}</h6>
                                        </div>
                                        <div class="">
                                            <a href="{{ route('yaedp.participant.profile.show',$product->id) }}"
                                                class="btn btn-outline-primary btn-afc-orange rounded">See all
                                                details</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card border border-dark article-card shadow-none rounded-0 " style="">
                                                <img src="{{ $product->first_image->path.'/'.$product->first_image->image }}" class="p-4 " alt="" style="height:300px;width: auto;object-fit:contain; ">
                                            </div>
                                            <button type="button" class="btn btn-primary mt-3 btn-afc-orange-green rounded-pill text-afc-orange">Certified &#10003;</button>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <h6>
                                                        Product Name
                                                    </h6>
                                                    <p>{{ $product->name }}</p>
                                                </div>
                                                <div class="">
                                                    <h6>Product Type</h6>
                                                    <p class="text-right">
                                                        {{ $product->type }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <h6>
                                                        Quantity Available
                                                    </h6>
                                                    <p>
                                                        {{ $product->quantity_available }}
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <h6>Production Capacity</h6>
                                                    <p class="text-right">
                                                        {{ $product->capacity }}
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <h6>
                                                        Packaging
                                                    </h6>
                                                    <p>
                                                        {{ $product->packaging_method }}
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <h6>Weight</h6>
                                                    <p class="text-right">
                                                        {{ $product->weight_per_pack }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="row"> 
      
      
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">

        <img src="/images/workshop_images/Rectangle 216.png"  class="img-fluid">
       
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">

        <img src="/images/workshop_images/Rectangle 216.png"  class="img-fluid">
       
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">

        <img src="/images/workshop_images/Rectangle 216.png"  class="img-fluid">
       
      </div> --}}



        </div>
    </div>
    </div>

    <br><br>



    </section>
@stop
