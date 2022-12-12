@extends('yaedp.media.layouts.app')

@section('title')
Media | yaedp
@endsection

@section('meta-tags')

    <meta name="description" content="African Food Changemakers | Terms of Use"/>
    <meta name="keywords" content="African Food Changemakers, Terms of Use"/>

    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
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
        .privacy-policy-accordion-header{
            background: #046B60;
            color: #fff;
            border-radius: 0;
            padding: 18px 28px 19px;
        }

        .privacy-policy-accordion-body{
            background: #eeeded;
            padding: 35px 28px 25px;
            border-top: none;
        }

        .justify-text{
            text-align: justify;
            text-justify: inter-word;
        }

    
    </style>
@stop

@section('content')



<div class="container-fluid p-5 p container-2" >
.

    <ul class="nav" >
        <li class="nav-item tab-heading " sty>
            <a class="nav-link tab-link-first" href="{{ route('yaedp.media.pictures') }}">Overview</a>
          </li>
        <li class="nav-item  tab-heading-active" >
          <a class="nav-link tab-text-active" aria-current="page" href="{{ route('yaedp.media.pictures') }}" >Media</a>
        </li>
        <li class="nav-item tab-heading" >
          <a class="nav-link" href="{{ route('yaedp.articles.index') }}">YAEDP Articles</a>
        </li>
        <li class="nav-item tab-heading">
          <a class="nav-link tab-link-last" href="{{ route('yaedp.participant.profile') }}">Participant’s Profile</a>
        </li>
       
      </ul>
      
      <h5 class="mt-5 text-dark">
        Media
      </h5>

      <ul class="nav " >
       
        <li class="nav-item  tab-heading" >
          <a class="nav-link  tab-link-first " aria-current="page" href="{{ route('yaedp.media.pictures') }}" >Pictures</a>
        </li>
        <li class="nav-item  tab-heading-active-2" >
          <a class="nav-link text-dark" href="{{ route('yaedp.media.videos') }}">Videos</a>
        </li>
       
       
      </ul>
      @foreach ($vedios as $item)
      <h5 class="mt-5 text-afc-orange">{{ $item->title }}</h5>



<div class="gallary">
    <div class="">
        <div class="row">
        
              
          @foreach ($item->videos as $video)
            <div class="col-sm-4 ">
               
                <div class="embed-responsive embed-responsive-16by9 rounded">
                    <iframe class="embed-responsive-item" src="{{ $video->video }}"></iframe>
                </div>
                <h5>{{ $video->title }}</h5>
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
@endforeach
 <br><br>



</section>
@stop
