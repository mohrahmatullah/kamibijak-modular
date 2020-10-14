@extends('frontend::dekstop.includes.default')
@section('title', 'Kamibijak | Page')
@section('content')
<style type="text/css">
  .page-t{
    color: #374957;
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 300;font-size: 1.5rem;
    line-height: 1.7;
  }
</style>
<main>
  
  <div class="container">
    <div class="row">
      <div class="col-12 pt-3">

        <div class="row justify-content-center">
          <div class="col-12">
            <ul class="nav nav-pills mb-3 my-xl-5 justify-content-center" id="pills-tab" role="tablist">
              @php
                $pages = DB::table('page')->get();
              @endphp
              @foreach($pages as $pg)
                <li class="nav-item">
                  <a href="{{ route('page', $pg->slug) }}" class="nav-link {{ ($pg->slug == request()->segment(2)) ? 'active' : '' }} text-capitalize">{{ $pg->title }}</a>
                </li>
              @endforeach
              <!-- <li class="nav-item">
                <a class="nav-link active text-capitalize" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="true">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-capitalize" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
              </li> -->
            </ul>
            <div class="row">
              @if(Request::is('page/kontak'))
              <div class="col-12 col-xl-6">
                <!-- <img class="w-100 h-auto" src="https://s3-ap-southeast-1.amazonaws.com/magazine.job-like.com/magazine/wp-content/uploads/2018/11/29103428/IMG_2286-1-e1543462511786.jpg" style="box-shadow: 17px 25px 47px rgba(8,25,43,.33);"> -->
                <iframe style="border: 0;border-radius: .25rem;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.101243149545!2d106.63844894975175!3d-6.2503886629157615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fc0d236a08a9%3A0x834e88db5d058f2c!2sMerahputih.com!5e0!3m2!1sen!2sid!4v1494992716535" width="100%" height="500" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
              </div>
              @endif
              <div class="col-12 col-xl-6">
                <h1 class="text-tosca mb-4" style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 700;font-size: 3rem;">{{ $page->title }}</h1>
                <p style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 300;font-size: 1.5rem;line-height: 1.7;">
                  {!! str_replace('<p>', '<p class="page-t">', $page->content)  !!}

                </p>
              </div>              
              @if(Request::is('page/tentang'))
              <div class="col-12 col-xl-6">
                <img class="w-100 h-auto" src="https://s3-ap-southeast-1.amazonaws.com/magazine.job-like.com/magazine/wp-content/uploads/2018/11/29103428/IMG_2286-1-e1543462511786.jpg" style="box-shadow: 17px 25px 47px rgba(8,25,43,.33);">
              </div>
              @endif
            </div>
            <!-- <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">

                <div class="row">
                  <div class="col-12 col-xl-6">
                    <h1 class="text-tosca mb-4" style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 700;font-size: 3rem;">Lorem ipsum dolor sit amet</h1>
                    <p style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 300;font-size: 1.5rem;line-height: 1.7;">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer a pretium purus, id tincidunt diam. Maecenas non mauris ut libero malesuada placerat. Sed id dui in lorem semper ultricies a at sapien. Maecenas rhoncus ipsum nec ornare elementum. Phasellus et convallis leo, vel ornare tortor. Ut feugiat lorem sit amet eros fringilla, ut fermentum lectus mattis. In a finibus elit. Donec hendrerit nisi sem, ac fermentum felis pharetra ut. Nunc vel sapien non diam dignissim finibus. In tincidunt venenatis tempor.
                    </p>
                  </div>
                  <div class="col-12 col-xl-6">
                    <img class="w-100 h-auto" src="https://s3-ap-southeast-1.amazonaws.com/magazine.job-like.com/magazine/wp-content/uploads/2018/11/29103428/IMG_2286-1-e1543462511786.jpg" style="box-shadow: 17px 25px 47px rgba(8,25,43,.33);">
                  </div>
                </div>

              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                
                <div class="row">
                  <div class="col-12 col-xl-6">
                    <iframe style="border: 0;border-radius: .25rem;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.101243149545!2d106.63844894975175!3d-6.2503886629157615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fc0d236a08a9%3A0x834e88db5d058f2c!2sMerahputih.com!5e0!3m2!1sen!2sid!4v1494992716535" width="100%" height="500" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                  </div>
                  <div class="col-12 col-xl-6">
                    <div class="mb-4">
                      <h1 class="text-tosca mb-1" style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 700;font-size: 3rem;">Email</h1>
                      <p style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 300;font-size: 1.5rem;line-height: 1.7;">
                        admin@merahputih.com
                      </p>
                    </div>
                    <div class="mb-4">
                      <h1 class="text-tosca mb-1" style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 700;font-size: 3rem;">Telephone</h1>
                      <p style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 300;font-size: 1.5rem;line-height: 1.7;">
                        021-2222-7536
                      </p>
                    </div>
                    <div class="mb-4">
                      <h1 class="text-tosca mb-1" style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 700;font-size: 3rem;">Whatsapp</h1>
                      <p style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 300;font-size: 1.5rem;line-height: 1.7;">
                        021-2222-7536
                      </p>
                    </div>
                    <div class="mb-4">
                      <h1 class="text-tosca mb-1" style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 700;font-size: 3rem;">Alamat</h1>
                      <p style="color: #374957;font-family: 'Source Sans Pro', sans-serif;font-weight: 300;font-size: 1.5rem;line-height: 1.7;">
                        Cluster Paramount Hill Golf Jalan Gading Golf Timur Blok GGT No 112, Gading Serpong 15810, Tangerang, Indonesia
                      </p>
                    </div>
                  </div>
                </div>

              </div>
            </div> -->
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
</main>
@endsection