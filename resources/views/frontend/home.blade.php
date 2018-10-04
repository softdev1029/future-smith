@extends('layouts.app')

@push('scripts')
    <!-- Javascript Library -->
    <script src="{{ asset('plugins/owlcarousel2/dist/owl.carousel.min.js') }}" defer></script>

    <!-- Page Javascript -->
    <script src="{{ asset('js/frontend/home.js') }}" defer></script>
@endpush

@push('stylesheets')
    <!-- Plugin StyleSheets -->
    <link href="{{ asset('plugins/owlcarousel2/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Page StyleSheets -->
    <link href="{{ asset('css/frontend/home.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row header-row">
        <div class="col-12 col-md-6 text-center text-md-right pb-3 pb-md-0 header-left">
            <img src="{{ asset('images/home/banner.png') }}" />
            <a href="#" class="btn btn-outline-primary join-us-primary">Join Us Now</a>
        </div>
        <div class="col-12 col-md-6 align-self-center text-center header-video">
            <iframe src="//www.youtube-nocookie.com/embed/FVpdUthXY2I" frameborder="0" allow="encrypted-media" allowfullscreen=""></iframe>
        </div>
    </div>
</div>

<div class="container-fluid text-center home-block-2 py-4">
    <p>If the thought of volunteering in a dusty op shop or harassing strangers with a jangling<br>donation tin makes you shudder; you’re in the right place. </p>
    <p><strong>Meaningful, fun, flexible volunteering is only a few steps away.<br>With Future Smith– the power is in your hands.</strong></p>
</div>

<div style="border-bottom: 1px solid #EEEEEE;box-sizing: border-box;">
  <div class="row bg-theme-gray p-3 how-it-work">
      <div class="col-12">
          <h2 class="font-weight-bold py-3 text-center">How it works</h2>
          <a href="#">Learn More</a>
          <div class="row">
              <div class="col-12 col-md-4 text-center">
                  <h3>1.</h3>
                  <p class="">Join Tribes where people<br>have similar skills as you.</p>
              </div>
              <div class="col-12 col-md-4 text-center">
                  <h3>2.</h3>
                  <p class="">Explore ongoing projects &amp;<br>participate in the ones that<br>interest you.</p>
              </div>
              <div class="col-12 col-md-4 text-center">
                  <h3>3.</h3>
                  <p class="">Contribute your skills.<br>Make a difference one project<br>at a time.</p>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="hear-from">
  <h2>Hear from some Future Smithers</h2>
  <div class="row hear-contents">
    <div class="col-lg-6 first-content">
      <img src={{ file_url(null) }}></img>
      <div class="hear-content px-2 py-2">
        <h3>Bob Marley</h3>
        <h4>Started the TechTime Project</h4>
        <p>The LASIK surgeon uses computer software to guide the IntraLase laser beam, which applies a series of tiny (3-micron-diameter) bubbles within the central layer of the cornea. </p>
      </div>
    </div>
    <div class="col-lg-6">
      <img src={{ file_url(null) }}></img>
      <div class="hear-content px-2 py-2">
        <h3>Bob Marley</h3>
        <h4>Started the TechTime Project</h4>
        <p>The LASIK surgeon uses computer software to guide the IntraLase laser beam, which applies a series of tiny (3-micron-diameter) bubbles within the central layer of the cornea. </p>
      </div>
    </div>
  </div>
</div>
<div class="projects my-4 mx-3">
    <div class="col text-center mt-5 mb-3">
        <h2 class="font-weight-bold">Participate Now</h2>
        <div class="proj-tribe-header">
          <p>You can join one of our many ongoing projects</p>
          <a href="{{ route('project.list') }}">See all</a>
        </div>
    </div>
    <div class="owl-container owl-carousel projects-slide">
        @foreach ($projects as $project)
        <div class="project-item">
          <div class="item-top">
            <img src="{{ file_url($project->image(), 'get', 'thumb') }}" alt="{{ $project->title }}">
            <div class="item-back"></div>
            <h3 >{{ $project->title }}</h3>
          </div>
          <p>{{ $project->description }}</p>
          <a href="{{ $project->link() }}">Learn more</a>
        </div>
        @endforeach
    </div>
</div>
<div class="tribes-list">
    <div class="col text-center mt-5 mb-3">
        <h2 class="font-weight-bold">Join a tribe</h2>
        <div class="proj-tribe-header">
          <p>Meet like-minded eople in 'Tribes' or groups around you</p>
          <a href="{{ route('tribe.list') }}">See all</a>
        </div>
    </div>
    <div class="owl-container owl-carousel tribes">
        @foreach ($tribes as $tribe)
        <div class="tribe-item">
          <img class="rounded-circle img-fluid"  src="{{ file_url($tribe->image(), 'get', 'thumb') }}" alt="{{ $tribe->title }}">
          <a href="{{ $tribe->link() }}" class="text-center">{{ $tribe->title }}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
