 <style>
 .breadcrumbs {
    background: #f4f8fd;
    font-size: 15px;
    padding: 10px;
	border-radius:10px;
    color: #777;
    position: relative;
}

.breadcrumbs span {
    font-weight: 500;
    font-size: 12px;
}
 </style>
 <?php
	$crit = new CDbCriteria();
	$crit->condition = 'kode_artikel = "'.$_GET['kode'].'" ';
	$artikel = Artikel::model()->findAll($crit);
	
	$role_id    = Yii::app()->session->get('apps_rolenama_usr');
	
	$img = Yii::app()->getBaseUrl(true) . '/upload/artikel/' . $artikel[0]['foto'];
 ?>
 <header class="style-4 border-top border-bottom" style="background: #f4f8fd;">
	<div class="container">
	<div class="breadcrumbs mb-2" style="top:-50px;left: -12px;color: #3289f1;">
		<span><a href="<?php echo Yii::app()->getBaseUrl(true); ?>">Home</a></span>
		› 
		<span><a href="<?php echo Yii::app()->controller->createUrl('site/artikel'); ?>">Artikel</a></span>
		›
		<span><a href="#"><?php echo $artikel[0]['getkategori']['tipe']; ?></a></span>
	</div>
	<h5 class="" style="margin-top:-60px;margin-left: -1px;color: #404040;">
        <?php echo $artikel[0]['judul']; ?>
      </h5>
	</div>
	<div class="content">
		<div class="container">
			<div class="row gx-0">
				
			</div>
		</div>
	</div>
	
</header>
 <main class="blog-page style-5">
	
	<section class="all-news blog bg-transparent style-3">
		<div class="container" style="top: -36px;">
			<ul class="nav nav-tabs" style="font-size: 12px;">
			  <li class="nav-item">
				<a class="nav-link active" aria-current="page" href="#">Item Detail</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" aria-current="page" href="#">Reviews</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" aria-current="page" href="#">Comment</a>
			  </li>
			</ul>
			<div class="row gx-4 gx-lg-5 mt-3">			
				
			</div>
		</div>
	</section>
	<!-- ====== end all-news ====== -->

</main>

<main class="blog-page style-5 color-4">
	<!-- ====== start all-news ====== -->
	<section class="all-news blog bg-transparent style-3">
		<div class="container">
			
			<div class="row">
				<div class="col-lg-8">
					<div class="blog-details-slider mb-10">
						<div class="content-card">
							<div class="img">
								<img src="<?php echo $img; ?>" alt="">
							</div>							
						</div>
					</div>
					<div class="d-flex small align-items-center justify-content-between mb-30 fs-12px">
						<div class="l_side d-flex align-items-center">
							<a href="#" class="me-3 me-lg-5">
								<span class="icon-20 rounded-circle d-inline-flex justify-content-center align-items-center text-uppercase bg-main p-1 me-2 text-white">
									a
								</span>
								<span class="">
									By Admin
								</span>
							</a>
							<a href="#" class="me-3 me-lg-5">
								<i class="bi bi-chat-left-text me-1"></i>
								<span>24 Comments</span>
							</a>
							<a href="#">
								<i class="bi bi-eye me-1"></i>
								<span>774k Views</span>
							</a>
						</div>
						<div class="r-side mt-1">
							<a href="#">
								<i class="bi bi-info-circle me-1"></i>
								<span>Report</span>
							</a>
						</div>
					</div>

					<div class="blog-content-info">
						<h5 class="fw-bold color-000 lh-4 mb-30"><?php echo $artikel[0]['judul']; ?></h5>
						<div class="text mb-10 color-666">
							<?php echo $artikel[0]['deskripsi']; ?>
						</div>
						
						<div class="twitter-info mt-60">
							<div class="blog-share mt-80">
								<div class="row align-items-center">
									<div class="col-lg-6">
										<div class="side-tags">
											<div class="content">
												<a href="#">WordPress</a>
												<a href="#">PHP</a>
												<a href="#">HTML/CSS</a>
												<a href="#">Figma</a>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="share-icons d-flex justify-content-lg-end mt-3 mt-lg-0">
											<h6 class="fw-bold me-3 flex-shrink-0 text-uppercase">
												Share on
											</h6>
											<a href="#">
												<i class="fab fa-facebook-f"></i>
											</a>
											<a href="#">
												<i class="fab fa-twitter"></i>
											</a>
											<a href="#">
												<i class="fab fa-tumblr"></i>
											</a>
											<a href="#">
												<i class="fas fa-rss"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="blog-comments mt-70">
							<div class="comment-card card p-5 radius-5 border-0 mt-50">
								<div class="d-flex">
									<div class="icon-60 rounded-circle img-cover overflow-hidden me-3 flex-shrink-0">
										<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/team/3.jpg" alt="">
									</div>
									<div class="inf">
										<h6 class="fw-bold">Russel B.</h6>
										<small class="color-999"> @russelb  - 15 Dec, 2022 </small>
										<div class="text color-000 fs-12px mt-10">
											Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum sed ut perspiciatis unde. Lorem ispum dolor sit amet
										</div>
										<div class="social-icons d-flex mt-20">
											<a href="#" class="icon-25 rounded-circle d-inline-flex overflow-hidden align-items-center justify-content-center fs-10px me-2">
												<i class="fab fa-twitter"></i>
											</a>
											<a href="#" class="icon-25 rounded-circle d-inline-flex overflow-hidden align-items-center justify-content-center fs-10px me-2">
												<i class="fab fa-facebook-f"></i>
											</a>
											<a href="#" class="icon-25 rounded-circle d-inline-flex overflow-hidden align-items-center justify-content-center fs-10px me-2">
												<i class="fab fa-instagram"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="comments-content mt-70">
								<h3 class="color-000 mb-0"> 02 Comments </h3>
								<div class="comment-replay-cont border-bottom border-1 brd-gray pb-40 pt-40">
									<div class="d-flex comment-cont">
										<div class="icon-60 rounded-circle img-cover overflow-hidden me-3 flex-shrink-0">
											<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/team/2.jpg" alt="">
										</div>
										<div class="inf">
											<div class="title d-flex justify-content-between">
												<h6 class="fw-bold fs-14px">Robert Downey Jr</h6>
												<span class="time fs-12px text-uppercase">
													3 hours ago
												</span>
											</div>
											<div class="text color-000 fs-12px mt-10">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Atume nusaate staman utra phone limo sumeria                                            
											</div>
											<a href="#" class="butn border border-1 rounded-pill border-blue4 mt-20 py-2 px-3 hover-blue4 color-blue4">
												<span class="fs-10px"> replay </span>
											</a>
										</div>
									</div>
									<div class="d-flex comment-replay ps-5 mt-30 ms-4">
										<div class="icon-40 rounded-circle img-cover overflow-hidden me-3 flex-shrink-0">
											<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/team/5.jpg" alt="">
										</div>
										<div class="inf">
											<div class="title d-flex justify-content-between">
												<h6 class="fw-bold fs-14px">Tobey McGuire</h6>
												<span class="time fs-12px text-uppercase">
													2 dayes ago
												</span>
											</div>
											<div class="text color-000 fs-12px mt-10">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Atume nusaate staman utra phone limo sumeria                                            
											</div>
											<a href="#" class="butn border border-1 rounded-pill border-blue4 mt-20 py-2 px-3 hover-blue4 color-blue4">
												<span class="fs-10px"> replay </span>
											</a>
										</div>
									</div>
								</div>
								<div class="comment-replay-cont pb-40 pt-40">
									<div class="d-flex comment-cont">
										<div class="icon-60 rounded-circle img-cover overflow-hidden me-3 flex-shrink-0">
											<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/team/4.jpg" alt="">
										</div>
										<div class="inf">
											<div class="title d-flex justify-content-between">
												<h6 class="fw-bold fs-14px">Ben Chiwell</h6>
												<span class="time fs-12px text-uppercase">
													December 25, 2022
												</span>
											</div>
											<div class="text color-000 fs-12px mt-10">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Atume nusaate staman utra phone limo sumeria                                            
											</div>
											<a href="#" class="butn border border-1 rounded-pill border-blue4 mt-20 py-2 px-3 hover-blue4 color-blue4">
												<span class="fs-10px"> replay </span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<form class="comment-form d-block pt-30">
								<h3 class="color-000 mb-40"> Leave A Comment </h3>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group mb-30">
											<textarea class="form-control radius-4 fs-12px p-3" rows="6" placeholder="Write your comment here"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group mb-4 mb-lg-0">
											<input type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your Name *">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<input type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your Email *">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-check mt-20">
											<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
											<label class="form-check-label fs-12px" for="flexCheckDefault">
												Save my name & email in this browser for next time I comment
											</label>
										  </div>
									</div>
									<div class="col-12">
										<a href="#" class="btn rounded-pill blue4-3Dbutn hover-blue4 sm-butn fw-bold mt-40">
											<span>Submit Comment </span>
										</a>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<?php
						$sideblog =  new Sideblog();
						echo $sideblog->navigation();
					?>
				</div>
			</div>
		</div>
	</section>
	<!-- ====== end all-news ====== -->


	<!-- ====== start Popular Posts ====== -->
	<section class="popular-posts related Posts section-padding pb-100 bg-gray5">
		<div class="container">
			<h5 class="fw-bold text-uppercase mb-50">Related Posts</h5>
			<div class="related-postes-slider position-relative">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="card border-0 bg-transparent rounded-0 p-0  d-block">
								<a href="page-single-post-5.html" class="img radius-7 overflow-hidden img-cover">
									<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/blog/1.jpg" class="card-img-top" alt="...">
								</a>
								<div class="card-body px-0">
									<small class="d-block date mt-10 fs-10px fw-bold">
										<a href="#" class="text-uppercase border-end brd-gray pe-3 me-3 color-blue4">News</a>
										<i class="bi bi-clock me-1"></i>
										<a href="#" class="op-8">Posted on 3 Days ago</a>
									</small>
									<h5 class="fw-bold mt-10 title">
										<a href="page-single-post-5.html">Crypto Trend 2023</a>
									</h5>
									<p class="small mt-2 op-8">If there’s one way that wireless technology has
										changed the way we work.
									</p>
									<div class="d-flex small mt-20 align-items-center justify-content-between op-9">
										<div class="l_side d-flex align-items-center">
											<span class="icon-20 rounded-circle d-inline-flex justify-content-center align-items-center text-uppercase bg-main p-1 me-2 text-white">
												a
											</span>
											<a href="#" class="mt-1">
												By Admin
											</a>
										</div>
										<div class="r-side mt-1">
											<i class="bi bi-chat-left-text me-1"></i>
											<a href="#">24</a>
											<i class="bi bi-eye ms-4 me-1"></i>
											<a href="#">774k</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="card border-0 bg-transparent rounded-0 p-0  d-block">
								<a href="page-single-post-5.html" class="img radius-7 overflow-hidden img-cover">
									<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/blog/7.png" class="card-img-top" alt="...">
								</a>
								<div class="card-body px-0">
									<small class="d-block date mt-10 fs-10px fw-bold">
										<a href="#" class="text-uppercase border-end brd-gray pe-3 me-3 color-blue4">News</a>
										<i class="bi bi-clock me-1"></i>
										<a href="#" class="op-8">Posted on 3 Days ago</a>
									</small>
									<h5 class="fw-bold mt-10 title">
										<a href="page-single-post-5.html">AI With Fingerprint</a>
									</h5>
									<p class="small mt-2 op-8">If there’s one way that wireless technology has
										changed the way we work.
									</p>
									<div class="d-flex small mt-20 align-items-center justify-content-between op-9">
										<div class="l_side d-flex align-items-center">
											<span class="icon-20 rounded-circle d-inline-flex justify-content-center align-items-center text-uppercase bg-main p-1 me-2 text-white">
												a
											</span>
											<a href="#" class="mt-1">
												By Admin
											</a>
										</div>
										<div class="r-side mt-1">
											<i class="bi bi-chat-left-text me-1"></i>
											<a href="#">24</a>
											<i class="bi bi-eye ms-4 me-1"></i>
											<a href="#">774k</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="card border-0 bg-transparent rounded-0 p-0  d-block">
								<a href="page-single-post-5.html" class="img radius-7 overflow-hidden img-cover">
									<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/blog/5.png" class="card-img-top" alt="...">
								</a>
								<div class="card-body px-0">
									<small class="d-block date mt-10 fs-10px fw-bold">
										<a href="#" class="text-uppercase border-end brd-gray pe-3 me-3 color-blue4">News</a>
										<i class="bi bi-clock me-1"></i>
										<a href="#" class="op-8">Posted on 3 Days ago</a>
									</small>
									<h5 class="fw-bold mt-10 title">
										<a href="page-single-post-5.html">NFT Game! New Oppoturnity</a>
									</h5>
									<p class="small mt-2 op-8">If there’s one way that wireless technology has
										changed the way we work.
									</p>
									<div class="d-flex small mt-20 align-items-center justify-content-between op-9">
										<div class="l_side d-flex align-items-center">
											<span class="icon-20 rounded-circle d-inline-flex justify-content-center align-items-center text-uppercase bg-main p-1 me-2 text-white">
												a
											</span>
											<a href="#" class="mt-1">
												By Admin
											</a>
										</div>
										<div class="r-side mt-1">
											<i class="bi bi-chat-left-text me-1"></i>
											<a href="#">24</a>
											<i class="bi bi-eye ms-4 me-1"></i>
											<a href="#">774k</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</section>
	<!-- ====== end Popular Posts ====== -->

</main>