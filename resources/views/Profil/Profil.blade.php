<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Template.Head')
    </head>
    <body>
        {{-- <div class='loader'>
            @include('Template.Loading')
        </div> --}}

        <div class="page-container">
            @include('Template.Navbar')
            @include('Template.Sidebar')
            
            {{-- ######################### Isi Tampil ########################## --}}
            <div class="page-content">
                <div class="main-wrapper">
                  <div class="row">
                    <div class="col-xl-12">
                    <img src="app\assets\images\palu.jpg" alt="" height="400px" width="1880px">
                        <div></div>
                        <!-- <div class="profile-cover"></div> -->
                        <div class="profile-header">
                            <div class="profile-img">
                                <img src="app\assets\images\user\{{ $userx->gambar }}" alt="">
                            </div>
                            <div class="profile-name">
                                <h3>{{ $userx->fullname }}</h3>
                            </div>
                            <div class="profile-header-menu">
                                <!-- <ul class="list-unstyled">
                                    <li><a href="#" class="active">Feed</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Friends</a></li>
                                    <li><a href="#">Photos</a></li>
                                    <li><a href="#">Videos</a></li>
                                    <li><a href="#">Music</a></li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Profil</h5>
                          <p>Hai <a href="#"> {{ $opd->fullname }}</a> Ternyata kamu punya Hobi {{ $opd->hobi }} Ya...</p>
                          <ul class="list-unstyled profile-about-list">
                              <li><i class="far fa-edit m-r-xxs"></i><span>Nama Lengkap :<a href="#"> {{ $opd->fullname }}</a></span></li>
                              <li><i class="far fa-building m-r-xxs"></i><span>NIP : <a href="#"> {{ $opd->nip }}</a></span></li>
                              <li><i class="far fa-compass m-r-xxs"></i><span>Instansi : <a href="#"> Pemerintah Kota Palu</a></span></li>
                              <li><i class="far fa-compass m-r-xxs"></i><span>Satuan Kerja : <a href="#"> {{ $opd->nama_opd }}</a></span></li>
                              <li><i class="far fa-compass m-r-xxs"></i><span>Alamat : <a href="#"> {{ $opd->alamat }}</a></span></li>
                              <li><i class="far fa-compass m-r-xxs"></i><span>Email : <a href="#"> {{ $opd->email }}</a></span></li>
                              <li><i class="far fa-compass m-r-xxs"></i><span>Nomor HP : <a href="#"> {{ $opd->no_hp }}</a></span></li>
                              <li><i class="far fa-compass m-r-xxs"></i><span>Role : <a href="#"> {{ $opd->role }}</a></span></li>
                              <li class="profile-about-list-buttons">
                                  <button class="btn btn-block btn-warning m-t-md">{{ $opd->is_active }}</button>
                                  <!-- <button class="btn btn-block btn-success m-t-md">Message</button> -->
                              </li>
                          </ul>
                      </div>
                  </div>
                  <!-- <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contact Info</h5>
                        <ul class="list-unstyled profile-about-list">
                            <li><i class="far fa-envelope m-r-xxs"></i><span>johan.doe@gmail.com</span></li>
                            <li><i class="far fa-compass m-r-xxs"></i><span>Lives in <a href="#">San Francisco, CA</a></span></li>
                            <li><i class="far fa-address-book m-r-xxs"></i><span>+1 (678) 290 1680</span></li>
                        </ul>
                    </div>
                </div> -->
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="card">
                      <div class="card-body">
                          <div class="post">
                              <div class="post-header">
                                  <img src="app\assets\images\user\{{ $userx->gambar }}" alt="">
                                  <div class="post-info">
                                      <span class="post-author">{{ $opd->fullname }}</span><br>
                                      <span class="post-date">{{ $opd->role }}</span>
                                  </div>
                                  <div class="post-header-actions">
                                      <a href="#"><i class="fas fa-ellipsis-h"></i></a>
                                  </div>
                              </div>
                              <div class="post-body">
                                  <p>Silahkan Like, Koment, Subscribe, dan jangan Lupa Share ke Orang-Orang Terdekat Anda.</p>
                                  <img src="../../assets/images/card-image.png" class="post-image" alt="">
                              </div>
                              <div class="post-actions">
                                  <ul class="list-unstyled">
                                      <li>
                                          <a href="#" class="like-btn"><i class="far fa-heart"></i>Like</a>
                                      </li>
                                      <li>
                                          <a href="#"><i class="far fa-comment"></i>Comment</a>
                                      </li>
                                      <li>
                                          <a href="#"><i class="far fa-paper-plane"></i>Share</a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="post-comments">
                                  <div class="post-comm">
                                      <img src="app\assets\images\im1.jpg" class="comment-img" alt="">
                                      <div class="comment-container">
                                          <span class="comment-author">
                                              Sonny Rosas
                                              <small class="comment-date">5min</small>
                                          </span>
                                      </div>
                                      <span class="comment-text">
                                          Mauris ultrices convallis massa, nec facilisis enim interdum ac.
                                      </span>
                                  </div>
                                  <div class="post-comm">
                                      <img src="app\assets\images\im2.jpg" class="comment-img" alt="">
                                      <div class="comment-container">
                                          <span class="comment-author">
                                              Jacob Lee
                                              <small class="comment-date">27min</small>
                                          </span>
                                      </div>
                                      <span class="comment-text">
                                          Cras tincidunt quam nisl, vitae aliquet enim pharetra at. Nunc varius bibendum turpis, vitae ultrices tortor facilisis ac.
                                      </span>
                                  </div>
                                  <div class="new-comment">
                                    <div class="input-group mb-3">
                                      <input type="text" class="form-control" placeholder="Type something" aria-label="Type Something" aria-describedby="button-addon2">
                                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Comment</button>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </div>
                  <div class="col-md-12 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Stories</h5>
                          <div class="story-list">
                              <div class="story">
                                  <a href="#"><img src="app\assets\images\im3.jpg" alt=""></a>
                                  <div class="story-info">
                                      <a href="#"><span class="story-author">Johan Doe</span></a>
                                      <span class="story-time">17min</span>
                                  </div>
                              </div>
                              <div class="story">
                                  <a href="#"><img src="app\assets\images\im4.png" alt=""></a>
                                  <div class="story-info">
                                      <a href="#"><span class="story-author">Nina Doe</span></a>
                                      <span class="story-time">54min</span>
                                  </div>
                              </div>
                              <div class="story">
                                  <a href="#"><img src="app\assets\images\im5.png" alt=""></a>
                                  <div class="story-info">
                                      <a href="#"><span class="story-author">John Doe</span></a>
                                      <span class="story-time">2hrs</span>
                                  </div>
                              </div>
                              <div class="story">
                                  <a href="#"><img src="app\assets\images\im6.png" alt=""></a>
                                  <div class="story-info">
                                      <a href="#"><span class="story-author">Nina Doe</span></a>
                                      <span class="story-time">7hrs</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </div>
                </div>
               </div>
                                  
             </div>
              
            </div>
            {{-- ######################### Batas Isi ########################## --}}

        </div>

        {{-- ################################# Modal ################################### --}}



        {{-- ############################## Batas Modal ################################ --}}
        
        
        <!-- Javascripts -->
        @include('Template.Script')

        <script>
            if (session('success'))
                Swal.fire({
                  position: "top-center",
                  text: "Success",
                  icon: "success",
                  title: "{{ Session::get('success') }}",
                  showConfirmButton: false,
                  timer: 3500
                });
            endif
        </script>
        
        <script>
            if (session('error'))
                Swal.fire({
                  position: "top-center",
                  text: "Upss Sorry !",
                  icon: "error",
                  title: "{{ Session::get('error') }}",
                  showConfirmButton: false,
                  timer: 5500
                });
            endif
        </script>
        
        <script>
            if (session('status'))
                Swal.fire({
                  position: "top-center",
                  text: "Success",
                  icon: "success",
                  title: "{{ Session::get('status') }}",
                  showConfirmButton: false,
                  timer: 3500
                });
            endif
        </script>

    </body>
</html>